<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsCallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsResultEntityTest;

/**
 * Class ListPaymentOptionsResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class ListPaymentOptionsResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => ListPaymentOptionsCallEntityTest::getScheme(),
            'result' => array(
                ListPaymentOptionsResultEntityTest::getScheme(),
            ),
        );
    }

    public function getEntity()
    {
        return new ListPaymentOptionsResponse();
    }
}
