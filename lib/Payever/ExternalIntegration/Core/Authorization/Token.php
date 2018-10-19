<?php
/**
 * This class represents Payever oAuth Token
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Authorization;

use Payever\ExternalIntegration\Core\Base\IToken;
use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents Payever oAuth Token
 *
 * PHP version 5.4
 *
 * @category  Authorization
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
abstract class Token implements IToken
{
    const SCOPE_CREATE_PAYMENT  = 'API_CREATE_PAYMENT';
    const SCOPE_PAYMENT_INFO    = 'API_PAYMENT_INFO';
    const SCOPE_PAYMENT_ACTIONS = 'API_PAYMENT_ACTIONS';

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
     * Token constructor with optional autoload
     *
     * @param array|null $params Token params
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

            if (json_last_error() !== JSON_ERROR_NONE) {
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
     *
     * @codeCoverageIgnore
     */
    public function save()
    {
        return $this->getParams();
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
        return array(
            'scope'         => $this->scope,
            'access_token'  => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'created_at'    => $this->createdAt,
            'updated_at'    => $this->updatedAt,
        );
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

        return false;
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
        return array(
            static::SCOPE_PAYMENT_ACTIONS,
            static::SCOPE_CREATE_PAYMENT,
            static::SCOPE_PAYMENT_INFO,
        );
    }

    /**
     * Sets Updated At
     *
     * @param int $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt ?: time();

        return $this;
    }

    /**
     * Sets Created At
     *
     * @param int $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt ?: time();

        return $this;
    }

    /**
     * Sets Refresh Token
     *
     * @param string $refreshToken
     *
     * @return self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Sets Access Token
     *
     * @param string $accessToken
     *
     * @return self
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
     * @return self
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }
}
