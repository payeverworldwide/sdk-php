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

use Payever\ExternalIntegration\Core\Helper\StringHelper;
use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;

/**
 * This class represents Create Payment Call Entity
 *
 * @method string           getChannel()
 * @method float            getAmount()
 * @method float            getFee()
 * @method string           getOrderId()
 * @method string           getCurrency()
 * @method CartItemEntity[] getCart()
 * @method string           getSalutation()
 * @method string           getFirstName()
 * @method string           getLastName()
 * @method string           getStreet()
 * @method string           getZip()
 * @method string           getCity()
 * @method string           getCountry()
 * @method string           getPhone()
 * @method string           getEmail()
 * @method string           getSuccessUrl()
 * @method string           getFailureUrl()
 * @method string           getCancelUrl()
 * @method string           getNoticeUrl()
 * @method string           getPendingUrl()
 * @method string           getXFrameHost()
 * @method array            getPayments()
 * @method string           getType()
 * @method self             setChannel()
 * @method self             setAmount()
 * @method self             setFee()
 * @method self             setOrderId()
 * @method self             setCurrency()
 * @method self             setSalutation()
 * @method self             setFirstName()
 * @method self             setLastName()
 * @method self             setStreet()
 * @method self             setZip()
 * @method self             setCity()
 * @method self             setCountry()
 * @method self             setPhone()
 * @method self             setEmail()
 * @method self             setSuccessUrl()
 * @method self             setFailureUrl()
 * @method self             setCancelUrl()
 * @method self             setNoticeUrl()
 * @method self             setPendingUrl()
 * @method self             setXFrameHost()
 * @method self             setPayments()
 * @method self             setType()
 */
class CreatePaymentCallEntity extends CallEntity
{
    /** @var string $channel */
    protected $channel;

    /** @var float $amount */
    protected $amount;

    /** @var float $fee */
    protected $fee;

    /** @var string $orderId */
    protected $orderId;

    /** @var string $currency */
    protected $currency;

    /** @var CartItemEntity[] $cart */
    protected $cart;

    /** @var string $salutation */
    protected $salutation;

    /** @var string $firstName */
    protected $firstName;

    /** @var string $lastName */
    protected $lastName;

    /** @var string $street */
    protected $street;

    /** @var string $zip */
    protected $zip;

    /** @var string $city */
    protected $city;

    /** @var string $country */
    protected $country;

    /** @var string $phone */
    protected $phone;

    /** @var string $email */
    protected $email;

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

    /** @var string $xFrameHost */
    protected $xFrameHost;

    /** @var array $payments */
    protected $payments;

    /** @var string $type */
    protected $type;

    /**
     * Sets Cart
     *
     * @param array|string $cart
     *
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
    }
}
