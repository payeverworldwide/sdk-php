<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;

/**
 * Class ShippingGoodsPaymentRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class ShippingGoodsPaymentRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'reason' => 'reason',
        'amount' => 1.00,
        'shipping_details' => array(
            "shippingMethod" => "Flat rate"
        )
    );

    public function getEntity()
    {
        return new ShippingGoodsPaymentRequest();
    }
}
