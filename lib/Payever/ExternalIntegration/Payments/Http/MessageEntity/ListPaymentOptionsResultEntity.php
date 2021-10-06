<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * This class represents List Payment Options Result Entity
 *
 * @method bool                             getAcceptFee()
 * @method bool                             getShippingAddressAllowed()
 * @method bool                             getShippingAddressEquality()
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class ListPaymentOptionsResultEntity extends AbstractPaymentOptionEntity
{
    /** @var bool $acceptFee */
    protected $acceptFee;

    /** @var bool $shippingAddressAllowed */
    protected $shippingAddressAllowed;

    /** @var bool $shippingAddressEquality */
    protected $shippingAddressEquality;

    /**
     * Sets Accept Fee
     *
     * @param bool $acceptFee
     */
    public function setAcceptFee($acceptFee)
    {
        $this->acceptFee = filter_var($acceptFee, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Sets shipping address allowed
     *
     * @param bool $shippingAddressAllowed
     */
    public function setShippingAddressAllowed($shippingAddressAllowed)
    {
        $this->shippingAddressAllowed = filter_var($shippingAddressAllowed, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Sets shipping address equality
     *
     * @param bool $shippingAddressEquality
     */
    public function setShippingAddressEquality($shippingAddressEquality)
    {
        $this->shippingAddressEquality = filter_var($shippingAddressEquality, FILTER_VALIDATE_BOOLEAN);
    }
}
