<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ErrorEntity;

/**
 * Class ErrorEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\ErrorEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ErrorEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'message' => 'Error occured'
    );

    public function testEntity()
    {
        $this->assertEntityScheme($this->getEntity(), false);
    }

    public function getEntity()
    {
        return new ErrorEntity(static::getScheme());
    }
}
