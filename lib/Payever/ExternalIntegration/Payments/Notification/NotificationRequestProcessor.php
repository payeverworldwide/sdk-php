<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Notification
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Notification;

use Payever\ExternalIntegration\Core\Lock\LockInterface;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\NotificationRequestEntity;
use Psr\Log\LoggerInterface;

/**
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class NotificationRequestProcessor
{
    const NOTIFICATION_LOCK_SECONDS = 30;
    const LOG_PREFIX = '[Notification]';

    /** @var NotificationHandlerInterface */
    protected $handler;

    /** @var LockInterface */
    protected $lock;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * NotificationService constructor.
     *
     * @param NotificationHandlerInterface $handler
     * @param LockInterface $lock
     * @param LoggerInterface $logger
     */
    public function __construct(
        NotificationHandlerInterface $handler,
        LockInterface $lock,
        LoggerInterface $logger
    ) {
        $this->handler = $handler;
        $this->lock = $lock;
        $this->logger = $logger;
    }

    /**
     * @param string|null $payload
     *
     * @return NotificationResult
     *
     * @throws \RuntimeException when couldn't get payload
     * @throws \UnexpectedValueException when notification validation failed
     */
    public function processNotification($payload = null)
    {
        if (is_null($payload)) {
            $payload = $this->getRequestPayload();
        }

        if (empty($payload)) {
            throw new \RuntimeException('Got empty notification payload', 20);
        }

        $notificationResult = new NotificationResult();
        $notificationEntity = $this->unserializePayload($payload);

        if (!$notificationEntity->isValid()) {
            throw new \UnexpectedValueException('Notification entity is invalid', 21);
        }

        $paymentId = $notificationEntity->getPayment()->getId();

        $this->logger->debug(sprintf('%s Attempting to lock %s', static::LOG_PREFIX, $paymentId));
        $this->lock->acquireLock($paymentId, static::NOTIFICATION_LOCK_SECONDS);
        $this->logger->debug(sprintf('%s Locked  %s', static::LOG_PREFIX, $paymentId));

        try {
            $this->handler->handleNotification($notificationEntity, $notificationResult);
        } catch (\Exception $exception) {
            $this->logger->critical(
                sprintf('%s Exception while handling notification: %s', static::LOG_PREFIX, $exception->getMessage())
            );
            $notificationResult->addException($exception);
        }

        $this->lock->releaseLock($paymentId);
        $this->logger->debug(sprintf('%s Unlocked  %s', static::LOG_PREFIX, $paymentId));

        $this->logger->info(
            sprintf(
                '%s Processed notification for payment %s: %s',
                static::LOG_PREFIX,
                $paymentId,
                (string) $notificationResult
            )
        );

        return $notificationResult;
    }

    /**
     * @param string $payload
     *
     * @return NotificationRequestEntity
     */
    protected function unserializePayload($payload)
    {
        return new NotificationRequestEntity(json_decode($payload, true));
    }

    /**
     * @return false|string
     */
    protected function getRequestPayload()
    {
        return file_get_contents('php://input');
    }
}
