<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\AuthenticationResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;

/**
 * Class AuthenticationResponseTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\ResponseEntity\AuthenticationResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity
 */
class AuthenticationResponseTest extends AbstractResponseEntityTest
{
    protected static $scheme = array(
        'access_token' => 'stub_access_token',
        'refresh_token' => 'stub_refresh_token',
        'scope' => OauthToken::SCOPE_PAYMENT_ACTIONS,
        'expires_in' => 3600,
    );

    public function getEntity()
    {
        return new AuthenticationResponse();
    }
}
