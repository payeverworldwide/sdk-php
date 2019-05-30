<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\GetCurrenciesResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class GetCurrenciesResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\MessageEntity\GetCurrenciesResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity
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
