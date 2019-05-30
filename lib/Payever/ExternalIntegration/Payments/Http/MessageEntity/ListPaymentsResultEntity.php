<?php
/**
 * This class represents List Payments Result Entity
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

use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;

/**
 * This class represents List Payments Result Entity
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
 * @method self                 setId()
 * @method self                 setStatus()
 * @method self                 setColorState()
 * @method self                 setMerchantName()
 * @method self                 setCustomerName()
 * @method self                 setPaymentType()
 * @method self                 setChannel()
 * @method self                 setReference()
 * @method self                 setAmount()
 * @method self                 setCurrency()
 * @method self                 setFee()
 * @method self                 setTotal()
 */
class ListPaymentsResultEntity extends ResultEntity
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
     * Sets Payment Details
     *
     * @param array $paymentDetails
     */
    public function setPaymentDetails($paymentDetails)
    {
        $this->paymentDetails = new PaymentDetailsEntity($paymentDetails);
    }
}
