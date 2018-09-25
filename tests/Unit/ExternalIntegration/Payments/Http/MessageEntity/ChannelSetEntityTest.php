<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ChannelSetEntity;

/**
 * Class ChannelSetEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\ChannelSetEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ChannelSetEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'name' => 'stub_name',
        'slug' => 'stub_slug',
        'configured' => true,
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'discr' => 'stub_description',
    );

    public function getEntity()
    {
        return new ChannelSetEntity();
    }
}
