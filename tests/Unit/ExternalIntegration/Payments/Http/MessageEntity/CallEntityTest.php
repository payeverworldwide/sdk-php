<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\CallEntity;

/**
 * Class CallEntityTest
 *
 * @covers \Payever\ExternalIntegration\Core\Base\MessageEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class CallEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'status' => 'failed',
        'business_id' => 'stub_business',
        'created_at' => self::DEFAULT_STUB_DATE,
    );

    public function getEntity()
    {
        return new CallEntity();
    }
}
