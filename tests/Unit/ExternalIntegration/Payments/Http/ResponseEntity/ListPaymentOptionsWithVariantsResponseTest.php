<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsWithVariantsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsCallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsVariantsResultEntityTest;

class ListPaymentOptionsWithVariantsResponseTest extends AbstractMessageEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => ListPaymentOptionsCallEntityTest::getScheme(),
            'result' => array(
                ListPaymentOptionsVariantsResultEntityTest::getScheme(),
            ),
        );
    }
    public function getEntity()
    {
        return new ListPaymentOptionsWithVariantsResponse();
    }
}
