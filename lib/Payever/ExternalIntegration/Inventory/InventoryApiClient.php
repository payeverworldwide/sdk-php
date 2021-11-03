<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Inventory
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Inventory;

use Payever\ExternalIntegration\Core\CommonProductsThirdPartyApiClient;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\DynamicResponse;
use Payever\ExternalIntegration\Inventory\Base\InventoryApiClientInterface;
use Payever\ExternalIntegration\Inventory\Base\InventoryIteratorInterface;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;

class InventoryApiClient extends CommonProductsThirdPartyApiClient implements InventoryApiClientInterface
{
    const SUB_URL_INVENTORY_CREATE = 'api/inventory/%s';
    const SUB_URL_INVENTORY_ADD = 'api/inventory/%s/add';
    const SUB_URL_INVENTORY_SUBTRACT = 'api/inventory/%s/subtract';

    /**
     * @inheritdoc
     */
    public function createInventory(InventoryCreateRequestEntity $entity)
    {
        $this->configuration->assertLoaded();
        $url = $this->getCreateInventoryUrl($entity->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function addInventory(InventoryChangedRequestEntity $entity)
    {
        $this->configuration->assertLoaded();
        $url = $this->getAddInventoryUrl($entity->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function subtractInventory(InventoryChangedRequestEntity $entity)
    {
        $this->configuration->assertLoaded();
        $url = $this->getSubtractInventoryUrl($entity->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken()->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build();

        return $this->executeRequest($request);
    }

    /**
     * @inheritdoc
     */
    public function exportInventory(InventoryIteratorInterface $inventoryIterator, $externalId)
    {
        $this->configuration->assertLoaded();
        $successCount = 0;

        foreach ($inventoryIterator as $requestEntity) {
            try {
                $requestEntity->setExternalId($externalId);
                $this->createInventory($requestEntity);
            } catch (\Exception $exception) {
                $this->configuration->getLogger()
                    ->critical(
                        'Inventory item failed to export',
                        [
                            'sku' => $requestEntity->getSku(),
                            'exception' => $exception->getMessage(),
                        ]
                    );
                throw $exception;
            }
        }

        return $successCount;
    }

    /**
     * @param string $externalId
     *
     * @return string
     */
    private function getCreateInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_CREATE, $externalId);
    }

    /**
     * @param string $externalId
     * @return string
     */
    private function getAddInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_ADD, $externalId);
    }

    /**
     * @param string $externalId
     * @return string
     */
    private function getSubtractInventoryUrl($externalId)
    {
        return $this->getBaseUrl() . sprintf(static::SUB_URL_INVENTORY_SUBTRACT, $externalId);
    }
}
