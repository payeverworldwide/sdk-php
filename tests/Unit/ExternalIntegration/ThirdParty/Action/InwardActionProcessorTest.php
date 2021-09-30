<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\Core\Logger\NullLogger;
use Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool;
use Payever\ExternalIntegration\ThirdParty\Action\ActionResult;
use Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\Tests\Bootstrap\TestCase;

class InwardActionProcessorTest extends TestCase
{
    /** @var ActionHandlerPool */
    private $handlerPool;

    /** @var InwardActionProcessor */
    private $actionRequestProcessor;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->handlerPool = $this->createTestProxy('Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerPool');
        $actionResult = new ActionResult();
        $logger = new NullLogger();

        $this->actionRequestProcessor = new InwardActionProcessor(
            $this->handlerPool,
            $actionResult,
            $logger
        );
    }

    /**
     * @throws \Exception
     */
    public function testNoHandlers()
    {
        $this->expectException(\RuntimeException::class);
        $this->actionRequestProcessor->process('stub');
    }

    /**
     * @dataProvider actionListDataProvider
     *
     * @param string $action
     * @throws \Exception
     */
    public function testSuccess($action)
    {
        $handler = $this->getMockForAbstractClass('Payever\ExternalIntegration\ThirdParty\Action\ActionHandlerInterface');
        $handler->expects($this->once())->method('getSupportedAction')->willReturn($action);
        $handler->expects($this->once())->method('handle')->withAnyParameters();

        $this->handlerPool->registerActionHandler($handler);

        $this->actionRequestProcessor->process($action, '{}');
    }

    public function actionListDataProvider()
    {
        return array_map(function ($el) { return [$el]; }, ActionEnum::enum());
    }
}
