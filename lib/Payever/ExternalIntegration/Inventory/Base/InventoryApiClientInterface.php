<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Inventory\Base;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;
use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface InventoryApiClientInterface
{
    /**
     * Create an inventory record on payever side.
     *
     * Only first request will actually create an inventory record for SKU,
     * all subsequent requests will be ignored.
     *
     * @param InventoryCreateRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     */
    public function createInventory(InventoryCreateRequestEntity $entity);

    /**
     * Inform payever about increased inventory for product
     *
     * @param InventoryChangedRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     */
    public function addInventory(InventoryChangedRequestEntity $entity);

    /**
     * Inform payever about decreased inventory for product
     *
     * @param InventoryChangedRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     */
    public function subtractInventory(InventoryChangedRequestEntity $entity);

    /**
     * Batch export inventory records to payever
     *
     * @param InventoryIteratorInterface $inventoryIterator
     * @param string $externalId
     *
     * @return int - Number of successfully exported records
     */
    public function exportInventory(InventoryIteratorInterface $inventoryIterator, $externalId);
}
