<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Inventory\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getSku()
 * @method int|null getQuantity()
 * @method int getStock()
 *
 * @method self setSku(string $sku)
 * @method self setQuantity(int $quantity)
 * @method self setStock(int $stock)
 */
class InventoryChangedEntity extends MessageEntity
{
    /**
     * Target product SKU
     *
     * @var string
     */
    protected $sku;

    /**
     * Diff between previous and current states (+/-)
     *
     * @var int|null
     */
    protected $quantity;

    /**
     * Actual quantity after this action
     *
     * @var int
     */
    protected $stock;

    /**
     * @return array
     */
    public function getRequired()
    {
        return array(
            'sku',
            'stock',
        );
    }
}
