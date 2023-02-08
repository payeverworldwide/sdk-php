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

use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;

/**
 * This class represents Get Transaction Result Entity
 *
 * @method string        getMerchantReference()
 * @method string        getId()
 * @method string        getStatus()
 * @method string        getSpecificStatus()
 * @method string        getColorState()
 * @method string        getMerchantName()
 * @method string        getCustomerName()
 * @method string        getPaymentType()
 * @method string        getLastAction()
 * @method string        getCustomerEmail()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method string        getChannel()
 * @method string        getReference()
 * @method float         getAmount()
 * @method string        getCurrency()
 * @method float         getFee()
 * @method float         getTotal()
 * @method AddressEntity getAddress()
 * @method AddressEntity getShippingAddress()
 * @method array         getPaymentDetailsArray()
 * @method int           getBusinessShippingOptionId()
 * @method string        getShippingType()
 * @method string        getShippingOptionName()
 * @method string        getShippingCategory()
 * @method string        getShippingMethodCode()
 * @method string        getShippingMethodName()
 * @method string        getDetailsSearchKey()
 * @method string        getCallbackTrigger()
 * @method string        getPlace()
 * @method float         getDeliveryFee()
 * @method float         getPaymentFee()
 * @method float         getDownPayment()
 * @method bool          getPaymentFeeAcceptedByMerchant()
 * @method bool          getPrefilled()
 * @method \stdClass[]   getActions()
 * @method self          setMerchantReference(string $merchantReference)
 * @method self          setId(string $id)
 * @method self          setStatus(string $status)
 * @method self          setSpecificStatus(string $specificStatus)
 * @method self          setColorState(string $colorState)
 * @method self          setMerchantName(string $merchantName)
 * @method self          setCustomerName(string $customerName)
 * @method self          setPaymentType(string $paymentType)
 * @method self          setLastAction(string $lastAction)
 * @method self          setCustomerEmail(string $customerEmail)
 * @method self          setChannel(string $channel)
 * @method self          setReference(string $reference)
 * @method self          setAmount(float $amount)
 * @method self          setCurrency(string $currency)
 * @method self          setFee(float $fee)
 * @method self          setTotal(float $total)
 * @method self          setPaymentDetailsArray(array $paymentDetailsArray)
 * @method self          setBusinessShippingOptionId(int $businessShippingOptionId)
 * @method self          setShippingType(string $shippingType)
 * @method self          setShippingOptionName(string $shippingOptionName)
 * @method self          setShippingCategory(string $shippingCategory)
 * @method self          setShippingMethodCode(string $shippingMethodCode)
 * @method self          setShippingMethodName(string $shippingMethodName)
 * @method self          setDetailsSearchKey(string $detailsSearchKey)
 * @method self          setCallbackTrigger(string $callbackTrigger)
 * @method self          setPlace(string $place)
 * @method self          setDeliveryFee(float $deliveryFee)
 * @method self          setPaymentFee(float $paymentFee)
 * @method self          setDownPayment(float $downPayment)
 * @method self          setActions(array $actions)
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class GetTransactionResultEntity extends ResultEntity
{
    /** @var string $merchantReference */
    protected $merchantReference;

    /** @var string $id */
    protected $id;

    /** @var string $status*/
    protected $status;

    /** @var string $specificStatus */
    protected $specificStatus;

    /** @var string $colorState */
    protected $colorState;

    /** @var string $merchantName */
    protected $merchantName;

    /** @var string $customerName */
    protected $customerName;

    /** @var string $paymentType */
    protected $paymentType;

    /** @var string $lastAction */
    protected $lastAction;

    /** @var string $customerEmail */
    protected $customerEmail;

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

    /** @var string $currency */
    protected $currency;

    /** @var float $fee */
    protected $fee;

    /** @var float $total */
    protected $total;

    /** @var AddressEntity $address */
    protected $address;

    /** @var AddressEntity $shippingAddress */
    protected $shippingAddress;

    /** @var array $paymentDetailsArray */
    protected $paymentDetailsArray;

    /** @var int $businessShippingOptionId */
    protected $businessShippingOptionId;

    /** @var string $shippingType */
    protected $shippingType;

    /** @var string $shippingOptionName */
    protected $shippingOptionName;

    /** @var string $shippingCategory */
    protected $shippingCategory;

    /** @var string $shippingMethodCode */
    protected $shippingMethodCode;

    /** @var string $shippingMethodName */
    protected $shippingMethodName;

    /** @var string $detailsSearchKey */
    protected $detailsSearchKey;

    /** @var string $callbackTrigger */
    protected $callbackTrigger;

    /** @var string $place */
    protected $place;

    /** @var float $deliveryFee */
    protected $deliveryFee;

    /** @var float $paymentFee */
    protected $paymentFee;

    /** @var float $downPayment */
    protected $downPayment;

    /** @var bool $paymentFeeAcceptedByMerchant */
    protected $paymentFeeAcceptedByMerchant;

    /** @var bool $prefilled */
    protected $prefilled;

    /** @var \stdClass[]|array $actions */
    protected $actions;

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
     * Sets Shipping Address
     *
     * @param array $shippingAddress
     * @return self
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = new AddressEntity($shippingAddress);

        return $this;
    }

    /**
     * Sets Payment Fee Accepted By Merchant
     *
     * @param bool $paymentFeeAcceptedByMerchant
     * @return self
     */
    public function setPaymentFeeAcceptedByMerchant($paymentFeeAcceptedByMerchant)
    {
        $this->paymentFeeAcceptedByMerchant = filter_var($paymentFeeAcceptedByMerchant, FILTER_VALIDATE_BOOLEAN);

        return $this;
    }

    /**
     * Sets Prefilled
     *
     * @param bool $prefilled
     * @return self
     */
    public function setPrefilled($prefilled)
    {
        $this->prefilled = filter_var($prefilled, FILTER_VALIDATE_BOOLEAN);

        return $this;
    }
}
