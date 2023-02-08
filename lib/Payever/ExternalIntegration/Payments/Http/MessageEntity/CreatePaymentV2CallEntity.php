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

use Payever\ExternalIntegration\Core\Helper\StringHelper;
use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;

/**
 * This class represents Create Payment Call Entity
 *
 * @method string           getStatus()
 * @method string           getId()
 * @method \DateTime|false      getCreatedAt()
 * @method string           getChannel()
 * @method float            getAmount()
 * @method float            getPaymentFee()
 * @method float            getDeliveryFee()
 * @method string           getReference()
 * @method string           getCurrency()
 * @method CartItemEntity[] getCart()
 * @method AddressEntity    getAddress()
 * @method AddressEntity    getShippingAddress()
 * @method string           getCustomerEmail()
 * @method float            getTotal()
 * @method float            getDownPayment()
 * @method string           getSuccessUrl()
 * @method string           getFailureUrl()
 * @method string           getCancelUrl()
 * @method string           getNoticeUrl()
 * @method string           getPendingUrl()
 * @method string           getCustomerRedirectUrl()
 * @method string           getPaymentType()
 * @method self             setStatus(string $status)
 * @method self             setId(string $id)
 * @method self             setChannel(string $name)
 * @method self             setAmount(float $amount)
 * @method self             setPaymentFee(float $paymentFee)
 * @method self             setDeliveryFee(float $deliveryFee)
 * @method self             setReference(string $reference)
 * @method self             setCurrency(string $currency)
 * @method self             setCustomerEmail(string $email)
 * @method self             setTotal(float $total)
 * @method self             setDownPayment(float $downPayment)
 * @method self             setSuccessUrl(string $successUrl)
 * @method self             setFailureUrl(string $failureUrl)
 * @method self             setCancelUrl(string $cancelUrl)
 * @method self             setNoticeUrl(string $noticeUrl)
 * @method self             setPendingUrl(string $pendingUrl)
 * @method self             setCustomerRedirectUrl(string $url)
 * @method self             setPaymentType(string $paymentType)
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class CreatePaymentV2CallEntity extends CallEntity
{
    /** @var string $status */
    protected $status;

    /** @var string $id */
    protected $id;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var string $channel */
    protected $channel;

    /** @var float $amount */
    protected $amount;

    /** @var float $paymentFee */
    protected $paymentFee;

    /** @var float $fee */
    protected $deliveryFee;

    /** @var string $reference */
    protected $reference;

    /** @var string $currency */
    protected $currency;

    /** @var CartItemEntity[] $cart */
    protected $cart;

    /** @var AddressEntity $address */
    protected $address;

    /** @var AddressEntity $shippingAddress */
    protected $shippingAddress;

    /** @var string $customerEmail */
    protected $customerEmail;

    /** @var float $total */
    protected $total;

    /** @var float $downPayment */
    protected $downPayment;

    /** @var string $successUrl */
    protected $successUrl;

    /** @var string $failureUrl */
    protected $failureUrl;

    /** @var string $cancelUrl */
    protected $cancelUrl;

    /** @var string $noticeUrl */
    protected $noticeUrl;

    /** @var string $pendingUrl */
    protected $pendingUrl;

    /** @var string $customerRedirectUrl */
    protected $customerRedirectUrl;

    /** @var string $paymentType */
    protected $paymentType;

    /**
     * Sets Cart
     *
     * @param array|string $cart
     * @return self
     * @throws \Exception
     */
    public function setCart($cart)
    {
        if (is_string($cart)) {
            $cart = StringHelper::jsonDecode($cart);
        }

        if ($cart && is_array($cart)) {
            foreach ($cart as $item) {
                $this->cart[] = new CartItemEntity($item);
            }
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
}
