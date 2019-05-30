<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Inventory\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getSku()
 * @method int getStock()
 * @method string getExternalId()
 *
 * @method self setStock(int $quantity)
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
     * @return array
     */
    public function getRequired()
    {
        return array(
            'externalId',
            'sku',
            'stock',
        );
    }
}
