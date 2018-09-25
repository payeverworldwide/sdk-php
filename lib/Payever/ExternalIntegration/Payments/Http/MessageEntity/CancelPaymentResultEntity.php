<?php
/**
 * This class represents Cancel Payment Result Entity
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

/**
 * This class represents Cancel Payment Result Entity
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
 * @method string               getId()
 * @method string               getStatus()
 * @method string               getColorState()
 * @method string               getMerchantName()
 * @method string               getCustomerName()
 * @method string               getPaymentType()
 * @method string               getLastAction()
 * @method \DateTime            getCreatedAt()
 * @method \DateTime            getUpdatedAt()
 * @method string               getChannel()
 * @method ChannelSetEntity     getChannelSet()
 * @method string               getReference()
 * @method array                getItems()
 * @method float                getAmount()
 * @method string               getCurrency()
 * @method float                getFee()
 * @method float                getOtherFees()
 * @method float                getPayeverCommission()
 * @method float                getTotal()
 * @method AddressEntity        getAddress()
 * @method PaymentDetailsEntity getPaymentDetails()
 * @method self                 setId()
 * @method self                 setStatus()
 * @method self                 setColorState()
 * @method self                 setMerchantName()
 * @method self                 setCustomerName()
 * @method self                 setPaymentType()
 * @method self                 setLastAction()
 * @method self                 setChannel()
 * @method self                 setReference()
 * @method self                 setItems()
 * @method self                 setAmount()
 * @method self                 setCurrency()
 * @method self                 setFee()
 * @method self                 setOtherFees()
 * @method self                 setPayeverCommission()
 * @method self                 setTotal()
 */
class CancelPaymentResultEntity extends ResultEntity
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

    /** @var string $paymentType */
    protected $paymentType;

    /** @var string $lastAction */
    protected $lastAction;

    /** @var \DateTime $createdAt */
    protected $createdAt;

    /** @var \DateTime $updatedAt */
    protected $updatedAt;

    /** @var string $channel */
    protected $channel;

    /** @var ChannelSetEntity $channelSet */
    protected $channelSet;

    /** @var string $reference */
    protected $reference;

    /** @var array $items */
    protected $items;

    /** @var float $amount */
    protected $amount;

    /** @var string $currency */
    protected $currency;

    /** @var float $fee */
    protected $fee;

    /** @var float $otherFees */
    protected $otherFees;

    /** @var float $payeverCommission */
    protected $payeverCommission;

    /** @var float $total */
    protected $total;

    /** @var AddressEntity $address */
    protected $address;

    /** @var PaymentDetailsEntity $paymentDetails */
    protected $paymentDetails;

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
