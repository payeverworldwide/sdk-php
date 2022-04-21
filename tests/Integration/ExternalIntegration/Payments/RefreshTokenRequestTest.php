<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;

class RefreshTokenRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::refreshTokenRequest()
     *
     * @throws \Exception
     */
    public function testRefreshTokenRequestSuccess()
    {
        $token = $this->paymentsApiClient->getTokens()->create();

        $tokenResponse = $this->invokeProtectedMethod(
            $this->paymentsApiClient,
            'obtainTokenRequest',
            array(OauthToken::SCOPE_CREATE_PAYMENT)
        );
        $tokenData = $tokenResponse->getResponseEntity()->toArray();

        $token->load($tokenData);

        self::assertTrue($tokenResponse->getResponseEntity()->isValid());

        $refreshToken = $token->getRefreshToken();
        $tokenRefreshResponse = $this->invokeProtectedMethod(
            $this->paymentsApiClient,
            'refreshTokenRequest',
            array($token)
        );
        $tokenData = $tokenRefreshResponse->getResponseEntity()->toArray();

        $token->load($tokenData);

        self::assertTrue($tokenRefreshResponse->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'method' => 'POST',
            'path' => '/oauth/v2/token',
            'body' => array(
                'scope' => OauthToken::SCOPE_CREATE_PAYMENT,
                'client_id' => $this->paymentsApiClient->getConfiguration()->getClientId(),
                'client_secret' => $this->paymentsApiClient->getConfiguration()->getClientSecret(),
                'grant_type' => OauthToken::GRAND_TYPE_REFRESH_TOKEN,
                'refresh_token' => $refreshToken,
            ),
        ));
    }
}
