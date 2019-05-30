<?php

namespace Payever\Tests\Unit\ExternalIntegration\Inventory\Http\RequestEntity;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class InventoryChangedRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'quantity' => 10,
        'sku' => 'stub_sku',
        'externalId' => 'stub_id',
    );

    public function getEntity()
    {
        return new InventoryChangedRequestEntity();
    }
}
