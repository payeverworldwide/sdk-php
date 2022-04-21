<?php

namespace Payever\Tests\Integration\ExternalIntegration\Core;

class GetCurrenciesRequestTest extends ApiClientBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::getCurrenciesRequest()
     *
     * @throws \Exception
     */
    public function testGetCurrenciesRequestDESuccess()
    {
        $response = $this->commonApiClient->getCurrenciesRequest('DE');

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/currency',
            'query' => '_locale=DE',
            'method' => 'GET',
        ));
    }

    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::getCurrenciesRequest()
     *
     * @throws \Exception
     */
    public function testGetCurrenciesRequestAllSuccess()
    {
        $response = $this->commonApiClient->getCurrenciesRequest();

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/currency',
            'query' => '',
            'method' => 'GET',
        ));
    }
}
