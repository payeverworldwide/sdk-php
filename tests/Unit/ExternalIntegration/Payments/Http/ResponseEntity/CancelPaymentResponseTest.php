<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\CancelPaymentResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\CancelPaymentResultEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntityTest;

/**
 * Class CancelPaymentResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\CancelPaymentResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class CancelPaymentResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => PaymentCallEntityTest::getScheme(),
            'result' => CancelPaymentResultEntityTest::getScheme(),
        );
    }

    public function getEntity()
    {
        return new CancelPaymentResponse();
    }
}
