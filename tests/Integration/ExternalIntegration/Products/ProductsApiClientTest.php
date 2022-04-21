<?php

namespace Payever\Tests\Integration\ExternalIntegration\Products;

use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\ExternalIntegration\Products\ProductsApiClient;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Bootstrap\Products\Base\ProductsIterator;
use Payever\Tests\Integration\ExternalIntegration\Core\ApiClientBaseTest;
use Psr\Log\LoggerInterface;

class ProductsApiClientTest extends ApiClientBaseTest
{
    const TEST_SKU = 'stub';
    const TEST_TITLE = 'stub';
    const TEST_EXTERNAL_ID = 'stub_external_id';

    /** @var ProductsApiClient */
    protected $productsApiClient;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->productsApiClient = new ProductsApiClient(
            ClientConfigurationProvider::getClientConfiguration()
        );

        // @TODO Allow product actions in stub server
    }

    public function testCreateProduct()
    {
        $entity = $this->getBaseProductEntity();
        $this->productsApiClient->createProduct($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/product/%s', $entity->getExternalId()),
            'method' => 'POST',
        ]);
    }

    public function testUpdateProduct()
    {
        $entity = $this->getBaseProductEntity();
        $this->productsApiClient->updateProduct($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/product/%s', $entity->getExternalId()),
            'method' => 'PATCH',
        ]);
    }


    public function testCreateOrUpdateProduct()
    {
        $entity = $this->getBaseProductEntity();
        $this->productsApiClient->createOrUpdateProduct($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/product/%s', $entity->getExternalId()),
            'method' => 'PUT',
        ]);
    }

    public function testRemoveProduct()
    {
        $entity = new ProductRemovedRequestEntity();
        $entity->setSku('stub');
        $entity->setExternalId('stub_external_id');

        $this->productsApiClient->removeProduct($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/product/%s', $entity->getExternalId()),
            'method' => 'DELETE',
            'body' => $entity->toArray(),
        ]);
    }

    public function testExportProducts()
    {
        $entity = $this->getBaseProductEntity();

        $this->productsApiClient->exportProducts(new ProductsIterator([$entity]), self::TEST_EXTERNAL_ID);

        $this->assertActualRequestData([
            'path' => sprintf('/api/product/%s', $entity->getExternalId()),
            'method' => 'PUT',
        ]);
    }

    public function testExportProductsCaseException()
    {
        $this->productsApiClient = new ProductsApiClient(
            $configuration = $this->getMockBuilder(ClientConfiguration::class)
                ->disableOriginalConstructor()
                ->getMock()
        );
        $entity = $this->getMockBuilder(ProductRequestEntity::class)
            ->disableOriginalConstructor()
            ->addMethods(['setExternalId'])
            ->getMock();
        $entity->expects($this->once())
            ->method('setExternalId')
            ->willThrowException(new \Exception());
        $configuration->expects($this->once())
            ->method('getLogger')
            ->willReturn($this->getMockBuilder(LoggerInterface::class)->getMock());
        $this->expectException(\Exception::class);
        $this->productsApiClient->exportProducts(new ProductsIterator([$entity]), self::TEST_EXTERNAL_ID);
    }

    /**
     * @return ProductRequestEntity
     */
    private function getBaseProductEntity()
    {
        $entity = new ProductRequestEntity();
        $entity->setExternalId(self::TEST_EXTERNAL_ID);
        $entity->setSku(self::TEST_SKU);
        $entity->setTitle(self::TEST_TITLE);

        return $entity;
    }
}
