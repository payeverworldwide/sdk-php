<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\ListPaymentsRequest;

class ListPaymentsRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listPaymentsRequest()
     *
     * @throws \Exception
     */
    public function testListPaymentsRequestSuccess()
    {
        $listRequest = new ListPaymentsRequest();
        $listRequest
            ->setCurrency('EUR')
            ->setPaymentMethod('paypal')
        ;
        $response = $this->paymentsApiClient->listPaymentsRequest($listRequest);

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => '/api/payment',
            'method' => 'GET',
        ));
    }
}
