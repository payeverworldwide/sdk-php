<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerInterface;
use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool;
use Payever\Tests\Bootstrap\TestCase;

class ActionHandlerPoolTest extends TestCase
{
    /** @var ActionHandlerPool */
    private $actionHandlerPool;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->actionHandlerPool = new ActionHandlerPool([
            $this->getMockForAbstractClass(ActionHandlerInterface::class)
        ]);
    }

    public function testEmptyPoolGetHandler()
    {
        $this->expectException(\RuntimeException::class);
        $this->actionHandlerPool->getHandlerForAction('stub');
    }

    public function testRegisterAndGetHandler()
    {
        $action = 'stub';

        $handler = $this->getMockForAbstractClass(ActionHandlerInterface::class);
        $handler->expects($this->once())->method('getSupportedAction')->willReturn($action);

        $this->actionHandlerPool->registerActionHandler($handler);
        $this->assertEquals(
            $handler,
            $this->actionHandlerPool->getHandlerForAction($action)
        );
    }
}
