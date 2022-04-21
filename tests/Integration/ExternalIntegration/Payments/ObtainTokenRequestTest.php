<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;

class ObtainTokenRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::obtainTokenRequest()
     *
     * @throws \Exception
     */
    public function testObtainTokenRequestSuccess()
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

        $this->assertActualRequestData(array(
            'method' => 'POST',
            'path' => '/oauth/v2/token',
            'body' => array(
                'scope' => OauthToken::SCOPE_CREATE_PAYMENT,
                'client_id' => $this->paymentsApiClient->getConfiguration()->getClientId(),
                'client_secret' => $this->paymentsApiClient->getConfiguration()->getClientSecret(),
                'grant_type' => OauthToken::GRAND_TYPE_OBTAIN_TOKEN,
            ),
        ));
    }

    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::obtainTokenRequest()
     */
    public function testTokenFailureOnWrongScope()
    {
        $this->expectException(\Exception::class);
        $this->invokeProtectedMethod(
            $this->paymentsApiClient,
            'obtainTokenRequest',
            array('bad_scope')
        );
    }
}
