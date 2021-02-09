<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class ProductVariantOptionEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'name' => 'size',
        'value' => '20',
    );

    public function getEntity()
    {
        return new ProductVariantOptionEntity();
    }

    public function testGetUnderscoreName()
    {
        $entity = $this->getEntity();
        $entity->setName('SomE nAmE');

        $this->assertEquals('some_name', $entity->getUnderscoreName());
    }
}
