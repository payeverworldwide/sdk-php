<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\ThirdParty\Action\ActionPayload;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\Tests\Bootstrap\TestCase;

class ActionPayloadTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGetPayloadForUnknownAction()
    {
        $this->expectException(\RuntimeException::class);
        $actionPayload = new ActionPayload('unknown', '{}');
        $actionPayload->getPayloadEntity();
    }

    /**
     * @throws \Exception
     */
    public function testNoPayload()
    {
        $this->expectException(\UnexpectedValueException::class);
        $actionPayload = new ActionPayload('unknown');
        $actionPayload->getPayloadEntity();
    }

    public function testGetRawPayload()
    {
        $payload = 'stub_payload';

        $actionPayload = new ActionPayload('stub', $payload);

        $this->assertEquals($payload, $actionPayload->getRawPayload());
    }

    /**
     * @param string $actionName
     * @param string $expectedEntityClass
     *
     * @dataProvider entityMappingDataProvider
     */
    public function testEntityMapping($actionName, $expectedEntityClass)
    {
        $actionPayload = new ActionPayload($actionName, '{}');

        $this->assertInstanceOf($expectedEntityClass, $actionPayload->getPayloadEntity());
    }

    /**
     * @return array
     */
    public function entityMappingDataProvider()
    {
        $productRequest = 'Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity';
        $productRemovedRequest = 'Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity';
        $inventoryRequest = 'Payever\ExternalIntegration\Inventory\Http\MessageEntity\InventoryChangedEntity';

        return array(
            array(ActionEnum::ACTION_CREATE_PRODUCT, $productRequest),
            array(ActionEnum::ACTION_UPDATE_PRODUCT, $productRequest),
            array(ActionEnum::ACTION_REMOVE_PRODUCT, $productRemovedRequest),
            array(ActionEnum::ACTION_ADD_INVENTORY, $inventoryRequest),
            array(ActionEnum::ACTION_SUBTRACT_INVENTORY, $inventoryRequest),
            array(ActionEnum::ACTION_SET_INVENTORY, $inventoryRequest),

        );
    }
}
