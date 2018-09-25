<?php

namespace Payever\Tests\Bootstrap\Plugin\Payments;

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\ExternalIntegration\Payments\Configuration as PaymentsConfiguration;

class Configuration extends PaymentsConfiguration
{
    const CLIENT_ID     = '2746_6abnuat5q10kswsk4ckk4ssokw4kgk8wow08sg0c8csggk4o00';
    const CLIENT_SECRET = '2fjpkglmyeckg008oowckco4gscc4og4s0kogskk48k8o8wgsc';
    const SLUG          = 'payever';

    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $this
            ->setChannelSet(ChannelSet::CHANNEL_MAGENTO)
            ->setApiMode(Configuration::MODE_SANDBOX)
            ->setClientId(self::CLIENT_ID)
            ->setClientSecret(self::CLIENT_SECRET)
            ->setDebugMode(true)
            ->setSlug(self::SLUG);
    }
}
