<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Base;

/**
 * Interface describes functions required to be implemented in v1 of Payever OauthToken
 */
interface OauthTokenInterface
{
    const SCOPE_CREATE_PAYMENT  = 'API_CREATE_PAYMENT';

    const SCOPE_PAYMENT_INFO    = 'API_PAYMENT_INFO';

    const SCOPE_PAYMENT_ACTIONS = 'API_PAYMENT_ACTIONS';

    const GRAND_TYPE_OBTAIN_TOKEN  = 'http://www.payever.de/api/payment';

    const GRAND_TYPE_REFRESH_TOKEN = 'refresh_token';

    /**
     * Returns access token
     *
     * @return string
     */
    public function getAccessToken();

    /**
     * Returns refresh token
     *
     * @return string
     */
    public function getRefreshToken();

    /**
     * Returns time in seconds till expiration
     *
     * @return int
     */
    public function getExpiresIn();

    /**
     * Returns the scope of the token
     *
     * @return string
     */
    public function getScope();

    /**
     * Returns available scopes
     *
     * @return array
     */
    public static function getScopes();

    /**
     * Returns available Grand Types
     *
     * @return array
     */
    public static function getGrandTypes();

    /**
     * Returns when the token was obtained
     *
     * @return int UNIX timestamp
     */
    public function getCreatedAt();

    /**
     * Returns when the token was updated
     *
     * @return int UNIX timestamp
     */
    public function getUpdatedAt();

    /**
     * Sets token update time
     *
     * @param int|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt = null);

    /**
     * Returns params hashsum
     *
     * @return string
     */
    public function getHash();

    /**
     * Returns array with OauthToken Params
     *
     * @return array
     */
    public function getParams();

    /**
     * Returns authorization string to be used in HTTP Header
     *
     * @return string
     */
    public function getAuthorizationString();

    /**
     * Checks if access token has expired
     *
     * @return bool
     */
    public function isExpired();

    /**
     * Checks if refresh token is still valid
     *
     * @return bool
     */
    public function isRefreshable();

    /**
     * Loads OauthToken data
     *
     * @param string|array $params
     *
     * @return $this
     */
    public function load($params);
}
