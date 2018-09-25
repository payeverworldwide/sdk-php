<?php
/**
 * Interface describes functions required to be implemented in v1 of Payever Token
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Base;

/**
 * Interface describes functions required to be implemented in v1 of Payever Token
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
interface IToken
{
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
     * Returns when the token was obtained
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Returns when the token was updated
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Sets token update time
     *
     * @param $updatedAt
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
     * Returns array with Token Params
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
     * Loads Token data
     *
     * @param string|array $params
     *
     * @return $this
     */
    public function load($params);

    /**
     * Saves Token data
     *
     * @return bool
     */
    public function save();
}
