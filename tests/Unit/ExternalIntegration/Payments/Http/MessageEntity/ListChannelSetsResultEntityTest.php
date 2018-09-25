<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListChannelSetsResultEntity;

/**
 * Class ListChannelSetsResultEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\ListChannelSetsResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ListChannelSetsResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'channel_type' => 'shopware',
        'channel_sets' => array(),
        'enabled' => true,
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['channel_sets'] = array(ChannelSetEntityTest::getScheme());

        return $scheme;
    }

    public function getEntity()
    {
        return new ListChannelSetsResultEntity();
    }
}
