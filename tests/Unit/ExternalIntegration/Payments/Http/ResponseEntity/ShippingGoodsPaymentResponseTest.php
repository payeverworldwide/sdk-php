<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ShippingGoodsPaymentResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ShippingGoodsPaymentResultEntityTest;

/**
 * Class ShippingGoodsPaymentResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\ShippingGoodsPaymentResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class ShippingGoodsPaymentResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => PaymentCallEntityTest::getScheme(),
            'result' => ShippingGoodsPaymentResultEntityTest::getScheme(),
        );
    }

    public function getEntity()
    {
        return new ShippingGoodsPaymentResponse();
    }
}
