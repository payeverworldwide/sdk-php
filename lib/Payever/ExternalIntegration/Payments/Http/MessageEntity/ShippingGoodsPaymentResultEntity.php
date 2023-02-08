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
 * @method self                 setAmount(float $amount)
 * @method self                 setChannel(string $channel)
 * @method self                 setColorState(string $colorState)
 * @method self                 setCurrency(string $currency)
 * @method self                 setCustomerName(string $customerName)
 * @method self                 setFee(float $fee)
 * @method self                 setId(string $id)
 * @method self                 setItems(array $items)
 * @method self                 setLastAction(string $lastAction)
 * @method self                 setMerchantName(string $merchantName)
 * @method self                 setOtherFees(float $otherFees)
 * @method self                 setPayeverCommission(float $payeverCommission)
 * @method self                 setPaymentType(string $paymentType)
 * @method self                 setReference(string $reference)
 * @method self                 setStatus(string $status)
 * @method self                 setTotal(float $total)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
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
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = new AddressEntity($address);

        return $this;
    }

    /**
     * Sets Channel Set
     *
     * @param array $channelSet
     * @return self
     */
    public function setChannelSet($channelSet)
    {
        $this->channelSet = new ChannelSetEntity($channelSet);

        return $this;
    }

    /**
     * Sets Created At
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        if ($createdAt) {
            $this->createdAt = date_create($createdAt);
        }

        return $this;
    }

    /**
     * Sets Updated At
     *
     * @param string $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        if ($updatedAt) {
            $this->updatedAt = date_create($updatedAt);
        }

        return $this;
    }

    /**
     * Sets Payment Details
     *
     * @param array $paymentDetails
     * @return self
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = new PaymentDetailsEntity($paymentDetails);

        return $this;
    }
}
