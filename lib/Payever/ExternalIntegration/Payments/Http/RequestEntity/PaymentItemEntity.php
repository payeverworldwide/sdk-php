<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * This class represents Payment Item RequestInterface Entity
 *
 * @method string    getName()
 * @method string    getIdentifier()
 * @method float     getPrice()
 * @method integer   getQuantity()
 * @method self      setName(string $name)
 * @method self      setIdentifier(string $identifier)
 * @method self      setPrice(float $price)
 * @method self      setQuantity(integer $quantity)
 */
class PaymentItemEntity extends RequestEntity
{
    /** @var string $name */
    protected $name;

    /** @var string $identifier */
    protected $identifier;

    /** @var float $price */
    protected $price;

    /** @var integer $quantity */
    protected $quantity;

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            (!$this->identifier || is_string($this->identifier)) &&
            (!$this->price || is_numeric($this->price)) &&
            (!$this->quantity || is_numeric($this->quantity));
    }

    /**
     * {@inheritdoc}
     */
    public function toArray($object = null)
    {
        return $object ? get_object_vars($object) : get_object_vars($this);
    }
}
