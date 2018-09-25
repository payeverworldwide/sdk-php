<?php
/**
 * This class represents Configuration
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\ExternalIntegration\Payments\Base\IConfiguration;

/**
 * This class represents Configuration
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
abstract class Configuration implements IConfiguration
{
    const MODE_SANDBOX = 'sandbox';
    const MODE_LIVE    = 'live';

    /** @var int $apiMode */
    protected $apiMode = self::MODE_SANDBOX;

    /** @var string $clientId */
    protected $clientId;

    /** @var string $clientSecret */
    protected $clientSecret;

    /** @var string $sandboxUrl */
    protected $sandboxUrl;

    /** @var bool $debugMode */
    protected $debugMode = true;

    /** @var string $slug */
    protected $slug;

    /** @var string $channelSet */
    protected $channelSet = ChannelSet::CHANNEL_OTHER_SHOPSYSTEM;

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
    public function getSlug()
    {
        return $this->slug;
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
    public function getDebugMode()
    {
        return $this->debugMode;
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
    public function getSandboxUrl()
    {
        return $this->sandboxUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return md5($this->getClientId() . $this->getClientSecret());
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
     * Sets Slug
     *
     * @param mixed $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
        if (in_array($channelSet, ChannelSet::getList())) {
            $this->channelSet = $channelSet;
        } else {
            throw new \Exception(sprintf('Channel Set `%s` is not valid', $channelSet));
        }

        return $this;
    }

    /**
     * Sets Debug mode
     *
     * @param bool $debugMode
     *
     * @return $this
     */
    public function setDebugMode($debugMode)
    {
        $this->debugMode = $debugMode;

        return $this;
    }

    /**
     * Sets Api mode
     *
     * @param string $apiMode
     *
     * @return $this
     */
    public function setApiMode($apiMode)
    {
        $this->apiMode = $apiMode;

        return $this;
    }

    /**
     * Sets Sandbox URL
     *
     * @param string $sandboxUrl
     *
     * @return $this
     */
    public function setSandboxUrl($sandboxUrl)
    {
        $this->sandboxUrl = $sandboxUrl;

        return $this;
    }
}
