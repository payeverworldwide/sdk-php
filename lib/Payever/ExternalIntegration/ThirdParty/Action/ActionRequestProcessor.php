<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class ActionRequestProcessor
{
    /** @var ActionHandlerPool */
    protected $actionHandlerPool;

    /** @var ActionResult */
    protected $actionResult;

    /** @var LoggerInterface */
    protected $logger;

    public function __construct(
        ActionHandlerPool $actionHandlerPool,
        ActionResult $actionResult,
        LoggerInterface $logger
    ) {
        $this->actionHandlerPool = $actionHandlerPool;
        $this->actionResult = $actionResult;
        $this->logger = $logger;
    }

    /**
     * Do the job of processing payever third-party action request
     *
     * @param string $action - action name {@see \Payever\ExternalIntegration\ThirdParty\Enum\Action}
     * @param string|null $payload - user can pass payload directly if it's coming from custom source
     *
     * @throws \Exception - bubbles up anything thrown inside
     */
    public function processActionRequest($action, $payload = null)
    {
        $loggerPrefix = '[ACTION_REQUEST]';

        $this->logger->info(
            sprintf('%s Processing action request', $loggerPrefix),
            compact('action')
        );

        $actionPayload = new ActionPayload($action, $payload);

        try {
            $handler = $this->actionHandlerPool->getHandlerForAction($action);

            if ($handler instanceof LoggerAwareInterface) {
                $handler->setLogger($this->logger);
            }

            $this->logger->debug(
                sprintf(
                    '%s Action request payload: %s',
                    $loggerPrefix,
                    $actionPayload->getRawPayload()
                )
            );

            $handler->handle($actionPayload, $this->actionResult);
        } catch (\Exception $exception) {
            $this->logger->critical(
                sprintf(
                    '%s Processing action failed. EXCEPTION: %s: %s',
                    $loggerPrefix,
                    $exception->getCode(),
                    $exception->getMessage()
                ),
                $this->getFinishLogContext($action)
            );

            throw $exception;
        }

        $this->logger->info(
            sprintf('%s Processed action request', $loggerPrefix),
            $this->getFinishLogContext($action)
        );
    }

    /**
     * @param string $action
     *
     * @return array
     */
    protected function getFinishLogContext($action)
    {
        return array(
            'action' => $action,
            'result' => $this->actionResult->toString(),
            'errors' => $this->actionResult->getErrors(),
        );
    }
}
