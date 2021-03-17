<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Action
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class InwardActionProcessor
{
    /** @var ActionHandlerPool */
    protected $actionHandlerPool;

    /** @var ActionResult */
    protected $actionResult;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param ActionHandlerPool $actionHandlerPool
     * @param ActionResult $actionResult
     * @param LoggerInterface $logger
     */
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
     * @param string $action - action name {@see ActionEnum}
     * @param array|string|null $payload - user can pass payload directly if it's coming from custom source
     *
     * @throws \Exception - bubbles up anything thrown inside
     *
     * @return ActionResult
     */
    public function process($action, $payload = null)
    {
        $loggerPrefix = '[INWARD_ACTION_REQUEST]';

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
                sprintf('%s Action request payload', $loggerPrefix),
                [$actionPayload->getRawPayload()]
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

        return $this->actionResult;
    }

    /**
     * @param string $action
     *
     * @return array
     */
    protected function getFinishLogContext($action)
    {
        return [
            'action' => $action,
            'result' => $this->actionResult->toString(),
            'errors' => $this->actionResult->getErrors(),
        ];
    }
}
