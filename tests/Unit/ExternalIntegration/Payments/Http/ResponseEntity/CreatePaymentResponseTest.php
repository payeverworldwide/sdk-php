<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\CreatePaymentResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\CreatePaymentCallEntityTest;

/**
 * Class CreatePaymentResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\CreatePaymentResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class CreatePaymentResponseTest extends AbstractResponseEntityTest
{
    protected static $scheme = array(
        'redirect_url' => 'https://sandbox.payver.de/pay/id',
        'call' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['call'] = CreatePaymentCallEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new CreatePaymentResponse();
    }
}
