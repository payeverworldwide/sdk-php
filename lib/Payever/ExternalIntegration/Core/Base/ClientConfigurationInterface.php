<?php

namespace Payever\ExternalIntegration\Core\Base;

use Payever\ExternalIntegration\Core\Exception\ConfigurationException;
use Psr\Log\LoggerInterface;

interface ClientConfigurationInterface
{
    const API_MODE_LIVE = 'live';

    const API_MODE_SANDBOX = 'sandbox';

    /**
     * Returns Client ID
     *
     * @return string
     */
    public function getClientId();

    /**
     * Returns Client Secret
     *
     * @return string
     */
    public function getClientSecret();

    /**
     * Returns Business UUID
     *
     * @return string
     */
    public function getBusinessUuid();

    /**
     * @return string
     */
    public function getApiMode();

    /**
     * Returns Channel Set
     *
     * @return string
     */
    public function getChannelSet();

    /**
     * @internal
     *
     * Returns custom API URL
     *
     * @return string
     */
    public function getCustomApiUrl();

    /**
     * Returns Configuration Hash
     *
     * @return string
     */
    public function getHash();

    /**
     * @return LoggerInterface
     */
    public function getLogger();

    /**
     * Returns if Configuration is loaded successfully
     *
     * @return bool
     */
    public function isLoaded();

    /**
     * Throws exception when not loaded
     *
     * @throws ConfigurationException
     *
     * @return void
     */
    public function assertLoaded();
}
