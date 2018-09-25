<?php

namespace Base\Plugin\Payever\Payments;

require_once '../../../src/Payever/ExternalIntegration/Payments/Configuration.php';

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\ExternalIntegration\Payments\Configuration as PaymentsConfiguration;

class Configuration extends PaymentsConfiguration
{
    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $config = DB::get('payever_payments')->select(array('name' => 'config'))->one();

        $this
            ->setChannelSet(ChannelSet::CHANNEL_OTHER_SHOPSYSTEM)
            ->setApiMode($config['api_mode'])
            ->setClientId($config['client_id'])
            ->setClientSecret($config['client_secret'])
            ->setDebugMode($config['debug_mode'])
            ->setSlug($config['slug'])
            ->setSandboxUrl($config['sandbox_url'])
            ;
    }
}
