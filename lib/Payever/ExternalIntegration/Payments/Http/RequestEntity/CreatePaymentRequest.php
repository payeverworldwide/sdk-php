<?php
/**
 * This class represents Create Payment RequestInterface Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\CartItemEntity;

/**
 * This class represents Create Payment RequestInterface Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string           getChannel()
 * @method integer          getChannelSetId()
 * @method float            getAmount()
 * @method float            getFee()
 * @method string           getOrderId()
 * @method string           getCurrency()
 * @method CartItemEntity[] getCart()
 * @method string           getSalutation()
 * @method string           getPaymentMethod()
 * @method string           getFirstName()
 * @method string           getLastName()
 * @method string           getStreet()
 * @method string           getStreetNumber()
 * @method string           getZip()
 * @method string           getCity()
 * @method string           getCountry()
 * @method string           getSocialSecurityNumber()
 * @method \DateTime|false  getBirthdate()
 * @method string           getPhone()
 * @method string           getEmail()
 * @method string           getSuccessUrl()
 * @method string           getFailureUrl()
 * @method string           getCancelUrl()
 * @method string           getNoticeUrl()
 * @method string           getPendingUrl()
 * @method string           getXFrameHost()
 * @method string           getPluginVersion()
 * @method self             setChannel(string $channel)
 * @method self             setChannelSetId(int $id)
 * @method self             setAmount(float $amount)
 * @method self             setFee(float $fee)
 * @method self             setOrderId(string $id)
 * @method self             setPaymentMethod(string $method)
 * @method self             setCurrency(string $currency)
 * @method self             setSalutation(string $salutation)
 * @method self             setFirstName(string $name)
 * @method self             setLastName(string $name)
 * @method self             setStreet(string $street)
 * @method self             setStreetNumber(string $streetNumber)
 * @method self             setZip(string $zip)
 * @method self             setCity(string $city)
 * @method self             setCountry(string $country)
 * @method self             setSocialSecurityNumber(string $ssn)
 * @method self             setPhone(string $phone)
 * @method self             setEmail(string $email)
 * @method self             setSuccessUrl(string $url)
 * @method self             setFailureUrl(string $url)
 * @method self             setCancelUrl(string $url)
 * @method self             setNoticeUrl(string $url)
 * @method self             setPendingUrl(string $url)
 * @method self             setXFrameHost(string $host)
 * @method self             setPluginVersion(string $version)
 */
class CreatePaymentRequest extends RequestEntity
{
    /** @var string $channel */
    protected $channel;

    /** @var integer $channelSetId */
    protected $channelSetId;

    /** @var string $paymentMethod */
    protected $paymentMethod;

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

    /** @var string $streetNumber */
    protected $streetNumber;

    /** @var string $zip */
    protected $zip;

    /** @var string $city */
    protected $city;

    /** @var string $country */
    protected $country;

    /** @var string $socialSecurityNumber */
    protected $socialSecurityNumber;

    /** @var \DateTime|bool $birthdate */
    protected $birthdate;

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

    /** @var string $pluginVersion */
    protected $pluginVersion;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        $required = array(
            'channel',
            'amount',
            'order_id',
            'currency',
        );

        return $required;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        if (is_array($this->cart)) {
            foreach ($this->cart as $item) {
                if (!$item instanceof CartItemEntity || !$item->isValid()) {
                    return false;
                }
            }
        }

        return parent::isValid() &&
            is_numeric($this->amount) &&
            is_array($this->cart) &&
            !empty($this->cart) &&
            (!$this->channelSetId || is_integer($this->channelSetId)) &&
            (!$this->fee || is_numeric($this->fee)) &&
            (!$this->birthdate || $this->birthdate instanceof \DateTime)
        ;
    }

    /**
     * Sets Cart
     *
     * @param array|string $cart
     */
    public function setCart($cart)
    {
        if (!$cart) {
            return;
        }

        if (is_string($cart)) {
            $cart = json_decode($cart);
        }

        if (!is_array($cart)) {
            return;
        }

        $this->cart = array();

        foreach ($cart as $item) {
            $this->cart[] = new CartItemEntity($item);
        }
    }

    /**
     * Sets Birthdate
     *
     * @param string $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = date_create($birthdate);
    }
}
