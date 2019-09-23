<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\ExternalIntegration\Plugins\Http\RequestEntity\PluginRegistryRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class PluginRegistryRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = [
        'pluginVersion' => '1.0.0',
        'cmsVersion' => '2.0.0',
        'channel' => ChannelSet::CHANNEL_MAGENTO,
        'host' => 'some.host.com',
        'supportedCommands' => [],
    ];

    public static function getScheme()
    {
        static::$scheme['supportedCommands'] = PluginCommandNameEnum::enum();

        return parent::getScheme();
    }

    public function getEntity()
    {
        return new PluginRegistryRequestEntity();
    }
}
