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

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * This class represents Shipping Details RequestInterface Entity
 *
 * @method string    getShippingCarrier()
 * @method string    getShippingMethod()
 * @method string    getTrackingNumber()
 * @method string    getTrackingUrl()
 * @method string    getShippingDate()
 * @method string    getReturnCarrier()
 * @method string    getReturnTrackingNumber()
 * @method string    getReturnTrackingUrl()
 * @method self      setShippingCarrier(string $shippingCarrier)
 * @method self      setShippingMethod(string $shippingMethod)
 * @method self      setTrackingNumber(string $trackingNumber)
 * @method self      setTrackingUrl(string $trackingUrl)
 * @method self      setShippingDate(string $shippingDate)
 * @method self      setReturnCarrier(string $returnCarrier)
 * @method self      setReturnTrackingNumber(string $returnTrackingNumber)
 * @method self      setReturnTrackingUrl(string $returnTrackingUrl)
 */
class ShippingDetailsEntity extends RequestEntity
{
    /** @var string $name */
    protected $shippingCarrier;

    /** @var string $shippingMethod */
    protected $shippingMethod;

    /** @var string $trackingNumber */
    protected $trackingNumber;

    /** @var string $trackingUrl */
    protected $trackingUrl;

    /** @var string $shippingDate */
    protected $shippingDate;

    /** @var string $returnCarrier */
    protected $returnCarrier;

    /** @var string $returnTrackingNumber */
    protected $returnTrackingNumber;

    /** @var string $returnTrackingUrl */
    protected $returnTrackingUrl;

    /**
     * {@inheritdoc}
     */
    public function toArray($object = null)
    {
        return $object ? get_object_vars($object) : get_object_vars($this);
    }
}
