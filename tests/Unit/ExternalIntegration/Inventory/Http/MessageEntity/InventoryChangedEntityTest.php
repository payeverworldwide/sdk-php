<?php

namespace Payever\Tests\Unit\ExternalIntegration\Inventory\Http\MessageEntity;

use Payever\ExternalIntegration\Inventory\Http\MessageEntity\InventoryChangedEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class InventoryChangedEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'sku' => 'stub_sku',
        'stock' => 10,
        'quantity' => -2,
    );

    public function getEntity()
    {
        return new InventoryChangedEntity();
    }
}
