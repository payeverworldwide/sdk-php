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
 * This class represents Retrieve Payment Result Entity
 *
 * @method string               getId()
 * @method string               getStatus()
 * @method string               getColorState()
 * @method string               getMerchantName()
 * @method string               getCustomerName()
 * @method string               getCustomerEmail()
 * @method string               getPaymentType()
 * @method string               getLastAction()
 * @method \DateTime|false      getCreatedAt()
 * @method \DateTime|false      getUpdatedAt()
 * @method string               getChannel()
 * @method string               getReference()
 * @method float                getAmount()
 * @method string               getCurrency()
 * @method float                getFee()
 * @method float                getTotal()
 * @method AddressEntity        getAddress()
 * @method PaymentDetailsEntity getPaymentDetails()
 * @method array                getPaymentDetailsArray()
 * @method ChannelSetEntity     getChannelSet()
 * @method float                getDownPayment()
 * @method self                 setId(string $id)
 * @method self                 setStatus(string $status)
 * @method self                 setColorState(string $colorState)
 * @method self                 setMerchantName(string $merchantName)
 * @method self                 setCustomerName(string $customerName)
 * @method self                 setCustomerEmail(string $customerEmail)
 * @method self                 setPaymentType(string $paymentType)
 * @method self                 setLastAction(string $lastAction)
 * @method self                 setChannel(string $channel)
 * @method self                 setReference(string $reference)
 * @method self                 setAmount(float $amount)
 * @method self                 setDownPayment(float $downPayment)
 * @method self                 setCurrency(string $currency)
 * @method self                 setFee(float $fee)
 * @method self                 setTotal(float $total)
 * @method self                 setPaymentDetailsArray(array $details)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class RetrievePaymentResultEntity extends ResultEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $status */
    protected $status;

    /** @var string $colorState */
    protected $colorState;

    /** @var string $merchantName */
    protected $merchantName;

    /** @var string $customerName */
    protected $customerName;

    /** @var string $customerName */
    protected $customerEmail;

    /** @var string $paymentType */
    protected $paymentType;

    /** @var string $lastAction */
    protected $lastAction;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var \DateTime|bool $updatedAt */
    protected $updatedAt;

    /** @var string $channel */
    protected $channel;

    /** @var string $reference */
    protected $reference;

    /** @var float $amount */
    protected $amount;

    /** @var float $amount */
    protected $downPayment;

    /** @var string $currency */
    protected $currency;

    /** @var float $fee */
    protected $fee;

    /** @var float $total */
    protected $total;

    /** @var AddressEntity $address */
    protected $address;

    /** @var PaymentDetailsEntity $paymentDetails */
    protected $paymentDetails;

    /** @var array $paymentDetailsArray */
    protected $paymentDetailsArray;

    /** @var ChannelSetEntity */
    protected $channelSet;

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
     * Sets Payment Details
     *
     * @param array $paymentDetails
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = new PaymentDetailsEntity($paymentDetails);
    }
}
