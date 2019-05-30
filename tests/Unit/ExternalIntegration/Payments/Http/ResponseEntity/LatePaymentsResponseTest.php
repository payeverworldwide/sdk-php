<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\LatePaymentsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntityTest;

/**
 * Class LatePaymentsResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\LatePaymentsResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class LatePaymentsResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => PaymentCallEntityTest::getScheme(),
        );
    }

    public function getEntity()
    {
        return new LatePaymentsResponse();
    }
}
