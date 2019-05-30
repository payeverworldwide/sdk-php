<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Inventory\Base;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryCreateRequestEntity;

/**
 * Interface InventoryIteratorInterface
 *
 * Implement this interface in order to batch export inventory info to payever
 * @see InventoryApiClientInterface::exportInventory()
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface InventoryIteratorInterface extends \Iterator
{
    /**
     * @return InventoryCreateRequestEntity
     */
    public function current();
}
