<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class ProductRemovedRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'sku' => 'stub_sku',
        'externalId' => 'stub_id',
    );

    public function getEntity()
    {
        return new ProductRemovedRequestEntity();
    }
}
