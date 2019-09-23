<?php

namespace Payever\Tests\Bootstrap\Plugins;

use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Plugins\Base\PluginRegistryInfoProviderInterface;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;

class PluginRegistryIntoProvider implements PluginRegistryInfoProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getPluginVersion()
    {
        return '1.0.0';
    }

    /**
     * @inheritdoc
     */
    public function getCmsVersion()
    {
        return '2.0.0';
    }

    /**
     * @inheritdoc
     */
    public function getHost()
    {
        return 'awesome.domain.me';
    }

    /**
     * @inheritdoc
     */
    public function getChannel()
    {
        return ChannelSet::CHANNEL_MAGENTO;
    }

    /**
     * @inheritdoc
     *
     * @throws \ReflectionException
     */
    public function getSupportedCommands()
    {
        return PluginCommandNameEnum::enum();
    }

    /**
     * @inheritdoc
     */
    public function getCommandEndpoint()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getBusinessIds()
    {
        return [];
    }
}
