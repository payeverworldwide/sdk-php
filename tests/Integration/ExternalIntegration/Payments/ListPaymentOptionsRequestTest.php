<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

class ListPaymentOptionsRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listPaymentOptionsRequest()
     *
     * @throws \Exception
     */
    public function testListPaymentOptionsRequestSuccess()
    {
        $slug = $this->paymentsApiClient->getConfiguration()->getBusinessUuid();
        $channel = $this->paymentsApiClient->getConfiguration()->getChannelSet();
        $response = $this->paymentsApiClient->listPaymentOptionsRequest();

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => sprintf('/api/shop/oauth/%s/payment-options/%s', $slug, $channel),
            'method' => 'GET',
        ));
    }
}
