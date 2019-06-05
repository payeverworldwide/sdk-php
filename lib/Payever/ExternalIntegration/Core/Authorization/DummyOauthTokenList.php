<?php

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