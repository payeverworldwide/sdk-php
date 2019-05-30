<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity\GetCurrenciesResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\GetCurrenciesResultEntityTest;

/**
 * Class GetCurrenciesResponseTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\ResponseEntity\GetCurrenciesResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity
 */
class GetCurrenciesResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        $childScheme = GetCurrenciesResultEntityTest::getScheme();

        return array(
            'result' => array(
                $childScheme['symbol'] => $childScheme,
            ),
        );
    }

    public function getEntity()
    {
        return new GetCurrenciesResponse(static::getScheme());
    }
}
