<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity\ProductCategoryEntityTest;

class ProductRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'externalId' => 'stub_id',
        'imagesUrl' => array('https://some.com/img.png'),
        'enabled' => false,
        'uuid' => 'stub_uuid',
        'businessUuid' => 'stub_business_uuid',
        'categories' => array(),
        'currency' => 'EUR',
        'title' => 'product_title',
        'description' => 'product description',
        'price' => 111.1,
        'salePrice' => 101.1,
        'hidden' => false,
        'sku' => 'stub_sku',
        'type' => 'physical',
    );

    public static function getScheme()
    {
        $scheme = parent::getScheme();
        $scheme['categories'][] = ProductCategoryEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new ProductRequestEntity();
    }
}
