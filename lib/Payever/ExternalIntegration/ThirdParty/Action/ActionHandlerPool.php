<?php

/**
 * PHP version 5.4 and 8
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

/**
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class ActionHandlerPool
{
    /** @var ActionHandlerInterface[] */
    protected $handlers;

    /**
     * @param ActionHandlerInterface[] $handlers
     */
    public function __construct(array $handlers = [])
    {
        $this->handlers = [];
        foreach ($handlers as $handler) {
            $this->registerActionHandler($handler);
        }
    }

    /**
     * @param ActionHandlerInterface $handler
     *
     * @return static
     */
    public function registerActionHandler(ActionHandlerInterface $handler)
    {
        $this->handlers[$handler->getSupportedAction()] = $handler;

        return $this;
    }

    /**
     * @param string $action on of @see {ActionEnum}
     *
     * @return ActionHandlerInterface
     * @throws \RuntimeException when can't find corresponding handler
     */
    public function getHandlerForAction($action)
    {
        if (isset($this->handlers[$action])) {
            return $this->handlers[$action];
        }

        throw new \RuntimeException(sprintf('No handler registered for %s action', $action));
    }
}
