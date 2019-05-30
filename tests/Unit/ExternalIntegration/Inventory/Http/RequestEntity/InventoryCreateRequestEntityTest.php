<?php

namespace Payever\Tests\Unit\ExternalIntegration\Inventory\Http\RequestEntity;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class InventoryCreateRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'sku' => 'stub_sku',
        'stock' => 12,
        'externalId' => 'stub_id',
    );

    public function getEntity()
    {
        return new InventoryCreateRequestEntity();
    }
}
