<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\ThirdParty\Action\BidirectionalActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Action\InwardActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Action\OutwardActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\Tests\Bootstrap\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class BidirectionalActionProcessorTest extends TestCase
{
    /** @var InwardActionProcessor|MockObject */
    private $inwardActionProcessor;

    /** @var OutwardActionProcessor|MockObject */
    private $outwardActionProcessor;

    /** @var BidirectionalActionProcessor */
    private $bidirectionalActionProcessor;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->inwardActionProcessor = $this->getMockBuilder(InwardActionProcessor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->outwardActionProcessor = $this->getMockBuilder(OutwardActionProcessor::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->bidirectionalActionProcessor = new BidirectionalActionProcessor(
            $this->inwardActionProcessor,
            $this->outwardActionProcessor
        );
    }

    public function testInward()
    {
        $action = ActionEnum::ACTION_SET_INVENTORY;

        $this->inwardActionProcessor->expects($this->once())->method('process')->with($action);

        $this->bidirectionalActionProcessor->processInwardAction($action);
    }

    public function testOutward()
    {
        $action = ActionEnum::ACTION_SET_INVENTORY;
        $payload = '';

        $this->outwardActionProcessor->expects($this->once())->method('process')->with($action, $payload);

        $this->bidirectionalActionProcessor->processOutwardAction($action, $payload);
    }
}
