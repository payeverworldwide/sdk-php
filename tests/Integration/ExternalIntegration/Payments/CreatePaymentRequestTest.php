<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;

class CreatePaymentRequestTest extends ApiBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::createPaymentRequest()
     *
     * @throws \Exception
     */
    public function testCreatePaymentRequestSuccess()
    {
        $response = $this->paymentsApiClient->createPaymentRequest($this->getCreatePaymentRequestEntity());

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => '/api/payment',
            'method' => 'POST',
            'body' => $this->getCreatePaymentData(),
        ));
    }

    /**
     * @param string $field
     * @param string $field2
     *
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::createPaymentRequest()
     *
     * @dataProvider failureDataProvider
     */
    public function testRequiredPaymentFieldsFailure($field, $field2 = null)
    {
        $this->expectException(\Exception::class);
        $params = $this->getCreatePaymentData();

        unset($params[$field]);

        if ($field2) {
            unset($params[$field2]);
        }

        $requestEntity = new CreatePaymentRequest($params);

        $this->paymentsApiClient->createPaymentRequest($requestEntity);
    }

    /**
     * @return array
     */
    public function failureDataProvider()
    {
        return array(
            array('amount'),
            array('order_id'),
            array('currency'),
            array('cart'),
            array('cart', 'amount'),
            array('currency', 'order_id'),
            array('amount', 'currency'),
        );
    }
}
