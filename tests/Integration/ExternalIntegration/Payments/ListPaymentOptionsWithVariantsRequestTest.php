<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsWithVariantsResponse;

class ListPaymentOptionsWithVariantsRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listPaymentOptionsWithVariantsRequest()
     *
     * @throws \Exception
     */
    public function testListPaymentOptionsRequestSuccess()
    {
        $slug = $this->paymentsApiClient->getConfiguration()->getBusinessUuid();
        $channel = $this->paymentsApiClient->getConfiguration()->getChannelSet();
        $response = $this->paymentsApiClient->listPaymentOptionsWithVariantsRequest();

        self::assertInstanceOf(ListPaymentOptionsWithVariantsResponse::class, $response->getResponseEntity());
        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => sprintf('/api/shop/oauth/%s/payment-options/variants/%s', $slug, $channel),
            'method' => 'GET',
        ));
    }
}
