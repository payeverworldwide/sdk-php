<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity\ProductCategoryEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntityTest;

class ProductRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'externalId' => 'stub_id',
        'imagesUrl' => array('https://some.com/img.png'),
        'active' => true,
        'uuid' => 'stub_uuid',
        'businessUuid' => 'stub_business_uuid',
        'categories' => array(),
        'currency' => 'EUR',
        'title' => 'product_title',
        'description' => 'product description',
        'price' => 111.1,
        'salePrice' => 101.1,
        'onSales' => true,
        'sku' => 'stub_sku',
        'type' => 'physical',
        'variants' => array(),
    );

    public static function getScheme()
    {
        $scheme = parent::getScheme();

        $variant = $scheme;
        $variant['options'] = array(ProductVariantOptionEntityTest::getScheme());

        $scheme['variants'][] = $variant;
        $scheme['categories'][] = ProductCategoryEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new ProductRequestEntity();
    }
}
