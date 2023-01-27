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
 * @method string           getRegion()
 * @method string           getCountry()
 * @method string           getPhone()
 * @method string           getEmail()
 * @method string           getSuccessUrl()
 * @method string           getFailureUrl()
 * @method string           getCancelUrl()
 * @method string           getNoticeUrl()
 * @method string           getPendingUrl()
 * @method string           getCustomerRedirectUrl()
 * @method string           getXFrameHost()
 * @method array            getPayments()
 * @method string           getType()
 * @method self             setChannel(string $name)
 * @method self             setAmount(float $amount)
 * @method self             setFee(float $fee)
 * @method self             setOrderId(string $orderId)
 * @method self             setCurrency(string $currency)
 * @method self             setSalutation(string $salutation)
 * @method self             setFirstName(string $firstName)
 * @method self             setLastName(string $lastName)
 * @method self             setStreet(string $street)
 * @method self             setZip(string $zip)
 * @method self             setCity(string $city)
 * @method self             setRegion(string $region)
 * @method self             setCountry(string $country)
 * @method self             setPhone(string $phone)
 * @method self             setEmail(string $email)
 * @method self             setSuccessUrl(string $successUrl)
 * @method self             setFailureUrl(string $failureUrl)
 * @method self             setCancelUrl(string $cancelUrl)
 * @method self             setNoticeUrl(string $noticeUrl)
 * @method self             setPendingUrl(string $pendingUrl)
 * @method self             setCustomerRedirectUrl(string $url)
 * @method self             setXFrameHost(string $xFrameHost)
 * @method self             setPayments(array $payments)
 * @method self             setType(string $type)
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.TooManyFields)
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

    /** @var string $region */
    protected $region;

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
