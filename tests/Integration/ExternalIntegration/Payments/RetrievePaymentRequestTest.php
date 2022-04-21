<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

class RetrievePaymentRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::retrievePaymentRequest()
     *
     * @throws \Exception
     */
    public function testRetrievePaymentRequestSuccess()
    {
        $paymentId = $this->getCreatePaymentEntity()->getCall()->getId();

        $response = $this->paymentsApiClient->retrievePaymentRequest($paymentId);

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => sprintf('/api/payment/%s', $paymentId),
            'method' => 'GET',
        ));
    }
}
