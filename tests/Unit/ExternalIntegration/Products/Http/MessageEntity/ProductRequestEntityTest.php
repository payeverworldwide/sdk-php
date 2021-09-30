<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class ProductRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'uuid' => 'b51e4bf9-ca97-4abf-a546-cce508fbff00',
        'externalId' => 'b51e4bf9-ca97-4abf-a546-cce508fbff00',
        'active' => true,
        'businessUuid' => 'b51e4bf9-ca97-4abf-a546-cce508fbff00',
        'currency' => 'EUR',
        'title' => 'stub_title',
        'description' => 'stub_description',
        'price' => 3.33,
        'salePrice' => 2.22,
        'onSales' => true,
        'sku' => 'stub-product',
        'vatRate' => 19.0,
    );

    public function getEntity()
    {
        return new ProductRequestEntity();
    }
}
