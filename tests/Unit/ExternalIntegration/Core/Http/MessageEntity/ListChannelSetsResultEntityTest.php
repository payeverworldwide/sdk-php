<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\ListChannelSetsResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class ListChannelSetsResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\MessageEntity\ListChannelSetsResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity
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
