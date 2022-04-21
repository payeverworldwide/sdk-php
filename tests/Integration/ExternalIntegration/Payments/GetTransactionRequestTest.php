<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

class GetTransactionRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::getTransactionRequest()
     *
     * @throws \Exception
     */
    public function testGetTransactionRequestSuccess()
    {
        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();
        $response = $this->paymentsApiClient->getTransactionRequest($transactionId);

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::getTransactionRequest()
     */
    public function testGetTransactionRequestNoIdFailure()
    {
        $this->expectException(\Exception::class);
        $this->paymentsApiClient->getTransactionRequest('');
    }
}
