<?php

namespace Payever\Tests\Integration\ExternalIntegration\Inventory;

use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;
use Payever\ExternalIntegration\Inventory\InventoryApiClient;
use Payever\Tests\Bootstrap\Inventory\Base\InventoryIterator;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Integration\ExternalIntegration\Core\ApiClientBaseTest;
use Psr\Log\LoggerInterface;

class InventoryApiClientTest extends ApiClientBaseTest
{
    const TEST_SKU = 'stub';
    const TEST_EXTERNAL_ID = 'stub_external_id';

    /** @var InventoryApiClient */
    protected $inventoryApiClient;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->inventoryApiClient = new InventoryApiClient(
            ClientConfigurationProvider::getClientConfiguration()
        );

        // @TODO Allow inventory actions inside stub server
    }

    public function testCreateInventory()
    {
        $entity = new InventoryCreateRequestEntity();
        $entity->setSku('stub');
        $entity->setStock(15);
        $entity->setExternalId('stub_external_id');

        $this->inventoryApiClient->createInventory($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/inventory/%s', $entity->getExternalId()),
            'method' => 'POST',
            'body' => $entity->toArray(),
        ]);
    }

    public function testAddInventory()
    {
        $entity = $this->getBaseInventoryChangedEntity();

        $this->inventoryApiClient->addInventory($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/inventory/%s/add', $entity->getExternalId()),
            'method' => 'POST',
            'body' => $entity->toArray(),
        ]);
    }


    public function testSubtractInventory()
    {
        $entity = $this->getBaseInventoryChangedEntity();

        $this->inventoryApiClient->subtractInventory($entity);

        $this->assertActualRequestData([
            'path' => sprintf('/api/inventory/%s/subtract', $entity->getExternalId()),
            'method' => 'POST',
            'body' => $entity->toArray(),
        ]);
    }

    public function testExportInventory()
    {
        $entity = new InventoryCreateRequestEntity();
        $entity->setSku(self::TEST_SKU);
        $entity->setExternalId(self::TEST_EXTERNAL_ID);
        $entity->setStock(1);

        $this->inventoryApiClient->exportInventory(new InventoryIterator([$entity]), self::TEST_EXTERNAL_ID);

        $this->assertActualRequestData([
            'path' => sprintf('/api/inventory/%s', $entity->getExternalId()),
            'method' => 'POST',
            'body' => $entity->toArray(),
        ]);
    }

    public function testExportInventoryCaseException()
    {
        $this->inventoryApiClient = new InventoryApiClient(
            $configuration = $this->getMockBuilder(ClientConfiguration::class)
                ->disableOriginalConstructor()
                ->getMock()
        );
        $entity = $this->getMockBuilder(InventoryCreateRequestEntity::class)
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
        $this->inventoryApiClient->exportInventory(new InventoryIterator([$entity]), self::TEST_EXTERNAL_ID);
    }

    /**
     * @return InventoryChangedRequestEntity
     */
    private function getBaseInventoryChangedEntity()
    {
        $entity = new InventoryChangedRequestEntity();
        $entity->setSku(self::TEST_SKU);
        $entity->setExternalId(self::TEST_EXTERNAL_ID);
        $entity->setQuantity(10);

        return $entity;
    }
}
