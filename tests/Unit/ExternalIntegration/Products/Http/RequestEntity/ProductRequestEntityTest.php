<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductCategoryEntity;
use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductShippingEntity;
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
        'createdAt' => '2020-01-01T00:00:00+00:00',
        'updatedAt' => '2020-01-01T00:00:00+00:00',
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

    public function testSetShipping()
    {
        $entity = $this->getEntity();
        $entity->setShipping(['weight' => 1]);

        $this->assertInstanceOf(ProductShippingEntity::class, $entity->getShipping());
    }

    public function testSetCategories()
    {
        $entity = $this->getEntity();
        $entity->setCategories([new ProductCategoryEntity(['title' => 'test'])]);

        $this->assertNotEmpty($entity->getCategories());
    }

    public function testAddOption()
    {
        $entity = $this->getEntity();
        $entity->addOption('color', 'green');

        $this->assertNotEmpty($entity->getOptions());
    }

    public function testGetImagesUuid()
    {
        $entity = $this->getEntity();
        $entity->setImages(['00000000-0000-0000-0000-000000000000.jpg']);

        $this->assertNotEmpty($entity->getImagesUuid());
    }

    public function testIsVariant()
    {
        $entity = $this->getEntity();
        $entity->addOption('color', 'green');

        $this->assertTrue($entity->isVariant());
    }

    public function testGetSku()
    {
        $entity = $this->getEntity();
        $entity->setSku($sku = 'some-sku');

        $this->assertEquals($sku, $entity->getSku());
    }
}
