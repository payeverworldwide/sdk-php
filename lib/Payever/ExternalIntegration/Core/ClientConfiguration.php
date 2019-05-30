<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\Base\ClientConfigurationInterface;
use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Core\Exception\ConfigurationException;
use Payever\ExternalIntegration\Core\Logger\NullLogger;
use Psr\Log\LoggerInterface;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class ClientConfiguration implements ClientConfigurationInterface
{
    /** @var string */
    protected $apiMode = self::API_MODE_LIVE;

    /** @var string $clientId */
    protected $clientId;

    /** @var string $clientSecret */
    protected $clientSecret;

    /** @var string $customApiUrl */
    protected $customApiUrl;

    /** @var string $businessUuid */
    protected $businessUuid;

    /** @var string $channelSet */
    protected $channelSet = ChannelSet::CHANNEL_OTHER_SHOPSYSTEM;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * ClientConfiguration constructor.
     *
     * @param string|null $clientId
     * @param string|null $clientSecret
     * @param string|null $businessUuid
     */
    public function __construct(
        $clientId = null,
        $clientSecret = null,
        $businessUuid = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->businessUuid = $businessUuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getBusinessUuid()
    {
        return $this->businessUuid;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiMode()
    {
        return $this->apiMode;
    }

    /**
     * {@inheritdoc}
     */
    public function getChannelSet()
    {
        return $this->channelSet;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomApiUrl()
    {
        return $this->customApiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return md5($this->getClientId() . $this->getClientSecret());
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        if (is_null($this->logger)) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }

    /**
     * Sets Client ID
     *
     * @param mixed $clientId
     *
     * @return self;
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Sets Client Secret
     *
     * @param mixed $clientSecret
     *
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Sets Business UUID
     *
     * @param mixed $businessUuid
     *
     * @return self
     */
    public function setBusinessUuid($businessUuid)
    {
        $this->businessUuid = $businessUuid;

        return $this;
    }

    /**
     * @param string $apiMode
     * @return self
     */
    public function setApiMode($apiMode)
    {
        $this->apiMode = $apiMode;

        return $this;
    }

    /**
     * Sets Channel set
     *
     * @param mixed $channelSet
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setChannelSet($channelSet = null)
    {
        if (in_array($channelSet, ChannelSet::enum())) {
            $this->channelSet = $channelSet;
        } else {
            throw new ConfigurationException(sprintf('Channel Set `%s` is not valid', $channelSet));
        }

        return $this;
    }

    /**
     * @internal
     *
     * Sets Custom API URL for all packages at once
     *
     * @param string $customApiUrl
     *
     * @return $this
     */
    public function setCustomApiUrl($customApiUrl)
    {
        $this->customApiUrl = $customApiUrl;

        return $this;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isLoaded()
    {
        return
            $this->getClientId() &&
            $this->getClientSecret() &&
            $this->getBusinessUuid()
        ;
    }

    /**
     * @inheritdoc
     */
    public function assertLoaded()
    {
        if (!$this->isLoaded()) {
            throw new ConfigurationException(
                "Payever API client credentials (client_id, client_secret, business_uuid) are not set."
            );
        }
    }
}
