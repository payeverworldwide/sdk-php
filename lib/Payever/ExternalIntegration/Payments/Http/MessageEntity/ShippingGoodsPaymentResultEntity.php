<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\ChannelSetEntity;
use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;

/**
 * This class represents Shipping Goods Payment Result Entity
 *
 * @method AddressEntity        getAddress()
 * @method float                getAmount()
 * @method string               getChannel()
 * @method ChannelSetEntity     getChannelSet()
 * @method string               getColorState()
 * @method \DateTime|false      getCreatedAt()
 * @method string               getCurrency()
 * @method string               getCustomerName()
 * @method float                getFee()
 * @method string               getId()
 * @method array                getItems()
 * @method string               getLastAction()
 * @method string               getMerchantName()
 * @method float                getOtherFees()
 * @method float                getPayeverCommission()
 * @method string               getPaymentType()
 * @method string               getReference()
 * @method string               getStatus()
 * @method float                getTotal()
 * @method \DateTime|false      getUpdatedAt()
 * @method PaymentDetailsEntity getPaymentDetails()
 * @method self                 setAmount()
 * @method self                 setChannel()
 * @method self                 setColorState()
 * @method self                 setCurrency()
 * @method self                 setCustomerName()
 * @method self                 setFee()
 * @method self                 setId()
 * @method self                 setItems()
 * @method self                 setLastAction()
 * @method self                 setMerchantName()
 * @method self                 setOtherFees()
 * @method self                 setPayeverCommission()
 * @method self                 setPaymentType()
 * @method self                 setReference()
 * @method self                 setStatus()
 * @method self                 setTotal()
 */
class ShippingGoodsPaymentResultEntity extends ResultEntity
{
    /** @var AddressEntity $address */
    protected $address;

    /** @var float $amount */
    protected $amount;

    /** @var string $channel */
    protected $channel;

    /** @var ChannelSetEntity $channelSet */
    protected $channelSet;

    /** @var string $colorState */
    protected $colorState;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var string $currency */
    protected $currency;

    /** @var string $customerName */
    protected $customerName;

    /** @var float $fee */
    protected $fee;

    /** @var string $id */
    protected $id;

    /** @var array $items */
    protected $items;

    /** @var string $lastAction */
    protected $lastAction;

    /** @var string $merchantName */
    protected $merchantName;

    /** @var float $otherFees */
    protected $otherFees;

    /** @var float $payeverCommission */
    protected $payeverCommission;

    /** @var string $paymentType */
    protected $paymentType;

    /** @var string $reference */
    protected $reference;

    /** @var string $status */
    protected $status;

    /** @var float $total */
    protected $total;

    /** @var \DateTime|bool $updatedAt */
    protected $updatedAt;

    /** @var PaymentDetailsEntity $paymentDetails */
    protected $paymentDetails;

    /**
     * Sets Address
     *
     * @param array $address
     */
    public function setAddress($address)
    {
        $this->address = new AddressEntity($address);
    }

    /**
     * Sets Channel Set
     *
     * @param array $channelSet
     */
    public function setChannelSet($channelSet)
    {
        $this->channelSet = new ChannelSetEntity($channelSet);
    }

    /**
     * Sets Created At
     *
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);
    }

    /**
     * Sets Updated At
     *
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = date_create($updatedAt);
    }

    /**
     * Sets Payment Details
     *
     * @param array $paymentDetails
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = new PaymentDetailsEntity($paymentDetails);
    }
}
