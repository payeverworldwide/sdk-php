<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  RequestEntity
 * @package   Payever\Inventory
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Inventory\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * @method string getSku()
 * @method int getStock()
 * @method string getExternalId()
 * @method self setExternalId(string $externalId)
 */
class InventoryCreateRequestEntity extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * Subscription external id.
     * Required for all requests.
     *
     * @var string
     */
    protected $externalId;

    /**
     * Target product SKU
     *
     * @var string
     */
    protected $sku;

    /**
     * Initial qty of a product.
     * Only first request will actually create an inventory record on payever side.
     * All further create requests will be ignored.
     *
     * @var int
     */
    protected $stock;

    /**
     * @param string $sku
     * @return static
     */
    public function setSku($sku)
    {
        $this->sku = (string) $sku;

        return $this;
    }

    /**
     * @param int|float|string $stock
     * @return static
     */
    public function setStock($stock)
    {
        $this->stock = (int) $stock;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'sku',
            'stock',
        ];
    }
}
