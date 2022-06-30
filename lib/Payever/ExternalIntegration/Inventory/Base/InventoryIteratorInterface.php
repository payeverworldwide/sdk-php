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

namespace Payever\ExternalIntegration\Inventory\Base;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;

/**
 * Interface InventoryIteratorInterface
 *
 * Implement this interface in order to batch export inventory info to payever
 * @see InventoryApiClientInterface::exportInventory()
 */
interface InventoryIteratorInterface extends \Iterator
{
    /**
     * @return InventoryCreateRequestEntity
     */
    #[\ReturnTypeWillChange]
    public function current();
}
