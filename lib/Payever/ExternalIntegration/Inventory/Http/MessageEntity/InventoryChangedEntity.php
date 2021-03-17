<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Inventory\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
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
        return [
            'sku',
            'stock',
        ];
    }
}
