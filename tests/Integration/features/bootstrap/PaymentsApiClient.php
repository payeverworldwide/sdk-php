<?php

namespace Payever\ExternalIntegration\Tests;

use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;

class PaymentsApiClient extends \Payever\ExternalIntegration\Payments\PaymentsApiClient
{
    public function obtainTokenRequest($scope)
    {
        return parent::obtainTokenRequest($scope);
    }

    public function refreshTokenRequest(OauthTokenInterface $token)
    {
        return parent::refreshTokenRequest($token);
    }
}
