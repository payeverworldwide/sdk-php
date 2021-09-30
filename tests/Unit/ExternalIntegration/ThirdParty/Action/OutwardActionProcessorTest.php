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

use Payever\ExternalIntegration\Core\Logger\NullLogger;
use Payever\ExternalIntegration\Inventory\InventoryApiClient;
use Payever\ExternalIntegration\Products\ProductsApiClient;
use Payever\ExternalIntegration\ThirdParty\Action\OutwardActionProcessor;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\Tests\Bootstrap\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class OutwardActionProcessorTest extends TestCase
{
    /** @var OutwardActionProcessor|MockObject  */
    private $outwardActionProcessor;

    /** @var ProductsApiClient|MockObject */
    private $productsApiClient;

    /** @var InventoryApiClient|MockObject */
    private $inventoryApiClient;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->productsApiClient = $this->getMockBuilder(ProductsApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->inventoryApiClient = $this->getMockBuilder(InventoryApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->outwardActionProcessor = new OutwardActionProcessor(
            $this->productsApiClient,
            $this->inventoryApiClient,
            new NullLogger()
        );
    }

    /**
     * @throws \Exception
     */
    public function testUnknownAction()
    {
        $this->expectException(\RuntimeException::class);
        $this->outwardActionProcessor->process('bad_action', '');
    }

    /**
     * @dataProvider actionProcessingDataProvider
     *
     * @param string $actionName
     * @param string $mockMethod
     * @throws \Exception
     */
    public function testActionProcessing($actionName, $mockMethod)
    {
        if (stripos($mockMethod, 'inventory') !== false) {
            $this->inventoryApiClient->expects($this->once())->method($mockMethod)->willReturn(true);
        } else {
            $this->productsApiClient->expects($this->once())->method($mockMethod)->willReturn(true);
        }

        $this->outwardActionProcessor->process($actionName, '');
    }

    /**
     * @return array
     */
    public function actionProcessingDataProvider()
    {
        return array(
            array(ActionEnum::ACTION_ADD_INVENTORY, 'addInventory'),
            array(ActionEnum::ACTION_SUBTRACT_INVENTORY, 'subtractInventory'),
            array(ActionEnum::ACTION_SET_INVENTORY, 'createInventory'),
            array(ActionEnum::ACTION_CREATE_PRODUCT, 'createOrUpdateProduct'),
            array(ActionEnum::ACTION_UPDATE_PRODUCT, 'createOrUpdateProduct'),
            array(ActionEnum::ACTION_REMOVE_PRODUCT, 'removeProduct'),
        );
    }
}
