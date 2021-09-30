<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Authorization;

use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;
use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents Payever oAuth OauthToken
 * @SuppressWarnings(PHPMD.MissingImport)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class OauthToken implements OauthTokenInterface
{
    /**
     * How long refresh_token should be considered valid (in seconds)
     */
    const REFRESH_TOKEN_LIFETIME = 864000;

    /**
     * How long access_token should be considered valid (in seconds)
     *
     * This will save us from errors caused by heavy network latency and other delay factors
     */
    const ACCESS_TOKEN_LIFETIME = 3540;

    /** @var string $accessToken */
    protected $accessToken;

    /** @var string $refreshToken */
    protected $refreshToken;

    /** @var int $createdAt */
    protected $createdAt;

    /** @var int $updatedAt */
    protected $updatedAt;

    /** @var string $scope */
    protected $scope;

    /**
     * OauthToken constructor with optional autoload
     *
     * @param array|null $params OauthToken params
     *
     * @throws \Exception
     */
    public function __construct($params = null)
    {
        $this->createdAt = time();

        if ($params) {
            $this->load($params);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load($params)
    {
        if (is_string($params)) {
            $params = json_decode($params);

            if (function_exists('json_last_error') && json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg(), json_last_error());
            }
        }

        foreach ($params as $key => $value) {
            $function = StringHelper::camelize('set_' . $key);

            if (method_exists($this, $function)) {
                $this->{$function}($value);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return md5(json_encode($this->getParams()));
    }

    /**
     * {@inheritdoc}
     */
    public function isExpired()
    {
        if ($this->getAccessToken() && $this->getExpiresIn() <= 0) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isRefreshable()
    {
        if ($this->getUpdatedAt()) {
            return (time() - $this->getUpdatedAt() < self::REFRESH_TOKEN_LIFETIME);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getParams()
    {
        return [
            'scope'         => $this->scope,
            'access_token'  => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'created_at'    => $this->createdAt,
            'updated_at'    => $this->updatedAt,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizationString()
    {
        return sprintf("Authorization: Bearer %s", $this->getAccessToken());
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiresIn()
    {
        if ($this->getUpdatedAt()) {
            return max(0, ($this->getUpdatedAt() - time()) + self::ACCESS_TOKEN_LIFETIME);
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * {@inheritdoc}
     */
    public static function getScopes()
    {
        return [
            static::SCOPE_PAYMENT_ACTIONS,
            static::SCOPE_CREATE_PAYMENT,
            static::SCOPE_PAYMENT_INFO,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getGrandTypes()
    {
        return [
            static::GRAND_TYPE_REFRESH_TOKEN,
            static::GRAND_TYPE_OBTAIN_TOKEN,
        ];
    }

    /**
     * Sets Updated At
     *
     * @param int|null $updatedAt
     *
     * @return static
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt ?: time();

        return $this;
    }

    /**
     * Sets Created At
     *
     * @param int|null $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt ?: time();

        return $this;
    }

    /**
     * Sets Refresh OauthToken
     *
     * @param string $refreshToken
     *
     * @return static
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Sets Access OauthToken
     *
     * @param string $accessToken
     *
     * @return static
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Sets Scope
     *
     * @param string $scope
     *
     * @return static
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }
}
