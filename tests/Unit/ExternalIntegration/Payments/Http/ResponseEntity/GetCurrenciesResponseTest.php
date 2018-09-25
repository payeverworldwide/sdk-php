<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetCurrenciesResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\GetCurrenciesResultEntityTest;

/**
 * Class GetCurrenciesResponseTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetCurrenciesResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class GetCurrenciesResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'result' => array(
                GetCurrenciesResultEntityTest::getScheme(),
            ),
        );
    }

    public function getEntity()
    {
        return new GetCurrenciesResponse(static::getScheme());
    }
}
