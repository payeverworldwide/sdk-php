<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsCallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsResultEntityTest;

/**
 * Class ListPaymentsResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentsResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class ListPaymentsResponseTest extends AbstractResponseEntityTest
{
    protected static $scheme = array(
        'redirect_url' => 'https://sandbox.payever.de/some/path',
        'call' => array(),
        'result' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['call'] = ListPaymentsCallEntityTest::getScheme();
        $scheme['result'] = array(
            ListPaymentsResultEntityTest::getScheme(),
        );

        return $scheme;
    }

    public function getEntity()
    {
        return new ListPaymentsResponse();
    }
}
