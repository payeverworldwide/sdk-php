<?php
/**
 * This class represents Cart Item Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Cart Item Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string getName()
 * @method float  getPrice()
 * @method float  getPriceNetto()
 * @method float  getVatRate()
 * @method float  getQuantity()
 * @method string getDescription()
 * @method string getThumbnail()
 * @method string getSku()
 * @method self   setName()
 * @method self   setPrice()
 * @method self   setPriceNetto()
 * @method self   setVatRate()
 * @method self   setQuantity()
 * @method self   setDescription()
 * @method self   setThumbnail()
 * @method self   setSku()
 */
class CartItemEntity extends MessageEntity
{
    /** @var string $name */
    protected $name;

    /** @var float $name */
    protected $price;

    /** @var float $priceNetto */
    protected $priceNetto;

    /** @var float $vatRate */
    protected $vatRate;

    /** @var float $quantity */
    protected $quantity;

    /** @var string $description */
    protected $description;

    /** @var string $thumbnail */
    protected $thumbnail;

    /** @var string $sku */
    protected $sku;

    /**
     * {@inheritdoc}
     */
    public function toArray($object = null)
    {
        return $object ? get_object_vars($object) : get_object_vars($this);
    }
}
