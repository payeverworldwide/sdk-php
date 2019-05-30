<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\Core\Logger\NullLogger;
use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool;
use Payever\ExternalIntegration\ThirdParty\Action\ActionRequestProcessor;
use Payever\ExternalIntegration\ThirdParty\Action\ActionResult;
use Payever\ExternalIntegration\ThirdParty\Enum\Action;
use Payever\Tests\Bootstrap\TestCase;

class ActionRequestProcessorTest extends TestCase
{
    /** @var ActionHandlerPool */
    private $handlerPool;

    /** @var ActionRequestProcessor */
    private $actionRequestProcessor;

    protected function setUp()
    {
        $this->handlerPool = $this->createTestProxy('Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool');
        $actionResult = new ActionResult();
        $logger = new NullLogger();

        $this->actionRequestProcessor = new ActionRequestProcessor(
            $this->handlerPool,
            $actionResult,
            $logger
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testNoHandlers()
    {
        $this->actionRequestProcessor->processActionRequest('stub');
    }

    public function testSuccess()
    {
        $action = Action::ACTION_CREATE_PRODUCT;

        $handler = $this->getMockForAbstractClass('Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerInterface');
        $handler->expects($this->once())->method('getSupportedAction')->willReturn($action);
        $handler->expects($this->once())->method('handle')->withAnyParameters();

        $this->handlerPool->registerActionHandler($handler);

        $this->actionRequestProcessor->processActionRequest($action, '{}');
    }
}
