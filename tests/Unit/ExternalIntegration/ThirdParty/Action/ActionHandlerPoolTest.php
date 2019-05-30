<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool;
use Payever\Tests\Bootstrap\TestCase;

class ActionHandlerPoolTest extends TestCase
{
    /** @var ActionHandlerPool */
    private $actionHandlerPool;

    protected function setUp()
    {
        $this->actionHandlerPool = new ActionHandlerPool();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testEmptyPoolGetHandler()
    {
        $this->actionHandlerPool->getHandlerForAction('stub');
    }

    public function testRegisterAndGetHandler()
    {
        $action = 'stub';

        $handler = $this->getMockForAbstractClass('Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerInterface');
        $handler->expects($this->once())->method('getSupportedAction')->willReturn($action);

        $this->actionHandlerPool->registerActionHandler($handler);
        $this->assertEquals(
            $handler,
            $this->actionHandlerPool->getHandlerForAction($action)
        );
    }
}
