<?php
/**
 * This class represents Get Transaction Result Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;

/**
 * This class represents Get Transaction Result Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string        getMerchantReference()
 * @method string        getId()
 * @method string        getStatu()
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
 * @method array         getActions()
 * @method self          setMerchantReference()
 * @method self          setId()
 * @method self          setStatu()
 * @method self          setSpecificStatus()
 * @method self          setColorState()
 * @method self          setMerchantName()
 * @method self          setCustomerName()
 * @method self          setPaymentType()
 * @method self          setLastAction()
 * @method self          setCustomerEmail()
 * @method self          setChannel()
 * @method self          setReference()
 * @method self          setAmount()
 * @method self          setCurrency()
 * @method self          setFee()
 * @method self          setTotal()
 * @method self          setPaymentDetailsArray()
 * @method self          setBusinessShippingOptionId()
 * @method self          setShippingType()
 * @method self          setShippingOptionName()
 * @method self          setShippingCategory()
 * @method self          setShippingMethodCode()
 * @method self          setShippingMethodName()
 * @method self          setDetailsSearchKey()
 * @method self          setCallbackTrigger()
 * @method self          setPlace()
 * @method self          setDeliveryFee()
 * @method self          setPaymentFee()
 * @method self          setDownPayment()
 * @method self          setActions()
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

    /** @var array $actions */
    protected $actions;

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
     * Sets Shipping Address
     *
     * @param array $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = new AddressEntity($shippingAddress);
    }

    /**
     * Sets Payment Fee Accepted By Merchant
     *
     * @param bool $paymentFeeAcceptedByMerchant
     */
    public function setPaymentFeeAcceptedByMerchant($paymentFeeAcceptedByMerchant)
    {
        $this->paymentFeeAcceptedByMerchant = filter_var($paymentFeeAcceptedByMerchant, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Sets Prefilled
     *
     * @param bool $prefilled
     */
    public function setPrefilled($prefilled)
    {
        $this->prefilled = filter_var($prefilled, FILTER_VALIDATE_BOOLEAN);
    }
}
