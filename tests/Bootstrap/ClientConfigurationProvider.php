<?php

namespace Payever\Tests\Bootstrap\Plugin;

use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\Enum\ChannelSet;

class ClientConfigurationProvider
{
    const CLIENT_ID     = '2746_6abnuat5q10kswsk4ckk4ssokw4kgk8wow08sg0c8csggk4o00';
    const CLIENT_SECRET = '2fjpkglmyeckg008oowckco4gscc4og4s0kogskk48k8o8wgsc';
    const BUSINESS_UUID = 'payever';

    /**
     * @return ClientConfiguration
     * @throws \Exception
     */
    public static function getClientConfiguration()
    {
        $configuration = new ClientConfiguration();

        $stubSandboxUrl = sprintf('http://%s:%s', STUB_SERVER_HOST, STUB_SERVER_PORT);

        $configuration
            ->setApiMode(ClientConfiguration::API_MODE_SANDBOX)
            ->setClientId(static::CLIENT_ID)
            ->setClientSecret(static::CLIENT_SECRET)
            ->setBusinessUuid(static::BUSINESS_UUID)
            ->setChannelSet(ChannelSet::CHANNEL_OTHER_SHOPSYSTEM)
            ->setCustomSandboxUrl($stubSandboxUrl)
            ->setCustomLiveUrl($stubSandboxUrl)
        ;

        return $configuration;
    }
}
