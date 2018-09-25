<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\GetCurrenciesResultEntity;

/**
 * Class GetCurrenciesResultEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\GetCurrenciesResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class GetCurrenciesResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'name' => 'US Dollar',
        'symbol' => 'USD',
        'code' => 'USD',
        'rate' => 1.3,
    );

    public function getEntity()
    {
        return new GetCurrenciesResultEntity();
    }
}
