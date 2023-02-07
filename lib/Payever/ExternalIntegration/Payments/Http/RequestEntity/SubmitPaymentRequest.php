<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\CartItemEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentDataEntity;

/**
 * This class represents Create Payment RequestInterface Entity
 *
 * @method string                 getChannel()
 * @method integer                getChannelSetId()
 * @method float                  getAmount()
 * @method float                  getFee()
 * @method string                 getOrderId()
 * @method string                 getCurrency()
 * @method CartItemEntity[]       getCart()
 * @method PaymentDataEntity|null getPaymentData()
 * @method string                 getSalutation()
 * @method string                 getPaymentMethod()
 * @method string|null            getVariantId()
 * @method string                 getFirstName()
 * @method string                 getLastName()
 * @method string                 getStreet()
 * @method string                 getStreetNumber()
 * @method string                 getZip()
 * @method string                 getCity()
 * @method string                 getRegion()
 * @method string                 getCountry()
 * @method string                 getSocialSecurityNumber()
 * @method \DateTime|false        getBirthdate()
 * @method string                 getPhone()
 * @method string                 getEmail()
 * @method string                 getSuccessUrl()
 * @method string                 getFailureUrl()
 * @method string                 getCancelUrl()
 * @method string                 getNoticeUrl()
 * @method string                 getPendingUrl()
 * @method string                 getCustomerRedirectUrl()
 * @method string                 getXFrameHost()
 * @method string                 getPluginVersion()
 * @method self                   setChannel(string $channel)
 * @method self                   setChannelSetId(int $id)
 * @method self                   setAmount(float $amount)
 * @method self                   setFee(float $fee)
 * @method self                   setOrderId(string $id)
 * @method self                   setPaymentMethod(string $method)
 * @method self                   setVariantId(string|null $variantId)
 * @method self                   setCurrency(string $currency)
 * @method self                   setSalutation(string $salutation)
 * @method self                   setFirstName(string $name)
 * @method self                   setLastName(string $name)
 * @method self                   setStreet(string $street)
 * @method self                   setStreetNumber(string $streetNumber)
 * @method self                   setZip(string $zip)
 * @method self                   setCity(string $city)
 * @method self                   setRegion(string $region)
 * @method self                   setCountry(string $country)
 * @method self                   setSocialSecurityNumber(string $ssn)
 * @method self                   setPhone(string $phone)
 * @method self                   setEmail(string $email)
 * @method self                   setSuccessUrl(string $url)
 * @method self                   setFailureUrl(string $url)
 * @method self                   setCancelUrl(string $url)
 * @method self                   setNoticeUrl(string $url)
 * @method self                   setPendingUrl(string $url)
 * @method self                   setCustomerRedirectUrl(string $url)
 * @method self                   setXFrameHost(string $host)
 * @method self                   setPluginVersion(string $version)
 */
class SubmitPaymentRequest extends CreatePaymentRequest
{
    /** @var PaymentDataEntity $paymentData */
    protected $paymentData;

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        if (!$this->paymentData instanceof PaymentDataEntity) {
            return false;
        }

        return parent::isValid();
    }

    /**
     * Sets payment data
     *
     * @param PaymentDataEntity|array|string $paymentData
     *
     * @return $this
     */
    public function setPaymentData($paymentData)
    {
        if (!$paymentData) {
            return $this;
        }

        if ($paymentData instanceof PaymentDataEntity) {
            $this->paymentData = $paymentData;

            return $this;
        }

        if (is_string($paymentData)) {
            $paymentData = json_decode($paymentData, true);
        }

        if (!is_array($paymentData)) {
            return $this;
        }

        $this->paymentData = new PaymentDataEntity($paymentData);

        return $this;
    }
}
