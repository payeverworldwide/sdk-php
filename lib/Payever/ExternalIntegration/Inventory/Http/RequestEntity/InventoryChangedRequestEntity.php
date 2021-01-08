<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Inventory\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Inventory
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getSku()
 * @method int getQuantity()
 * @method string getExternalId()
 *
 * @method self setQuantity(int $quantity)
 * @method self setExternalId(string $externalId)
 */
class InventoryChangedRequestEntity extends RequestEntity
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
     * Unsigned diff between previous and current states.
     * Addition or subtraction is indicated by endpoint this entity sent to.
     *
     * @var int
     */
    protected $quantity;

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
            'quantity',
        );
    }
}
