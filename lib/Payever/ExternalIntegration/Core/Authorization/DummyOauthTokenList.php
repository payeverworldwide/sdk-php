<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core\Authorization;

/**
 * Class DummyOauthTokenList
 *
 * Default storage of Oauth tokens if none explicitly provided.
 * Tokens are retrieved & stored in memory for each request.
 *
 * NOTE: It is strongly recommended to implement your own persistent tokens storage.
 *
 * @package Payever\ExternalIntegration\Core\Authorization
 */
class DummyOauthTokenList extends OauthTokenList
{
    /**
     * @inheritdoc
     */
    public function load()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this;
    }
}
