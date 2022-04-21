<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

class RetrieveApiCallRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::retrieveApiCallRequest()
     * @throws \Exception
     */
    public function testRetrieveApiCallRequestSuccess()
    {
        $this->expectException(\Exception::class);
        $response = $this->paymentsApiClient->retrieveApiCallRequest(
            $this->getCreatePaymentEntity()->getCall()->getId()
        );

        self::assertTrue($response->getResponseEntity()->isValid());
    }
}
