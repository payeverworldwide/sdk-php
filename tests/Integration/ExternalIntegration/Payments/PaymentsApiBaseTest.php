<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;
use Payever\ExternalIntegration\Payments\PaymentsApiClient;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Integration\ExternalIntegration\Core\ApiClientBaseTest;

abstract class ApiBaseTest extends ApiClientBaseTest
{
    /** @var PaymentsApiClient $paymentsApiClient */
    protected $paymentsApiClient;

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->paymentsApiClient = new PaymentsApiClient(
            ClientConfigurationProvider::getClientConfiguration()
        );
    }

    /**
     * @return \Payever\ExternalIntegration\Payments\Http\ResponseEntity\CreatePaymentResponse
     *
     * @throws \Exception
     */
    protected function getCreatePaymentEntity()
    {
        $response = $this->paymentsApiClient->createPaymentRequest($this->getCreatePaymentRequestEntity());

        if ($response->getResponseEntity()->isFailed()) {
            $this->fail("Couldn't create payment for further testing");
        }

        return $response->getResponseEntity();
    }

    /**
     * @return CreatePaymentRequest
     */
    protected function getCreatePaymentRequestEntity()
    {
        return new CreatePaymentRequest($this->getCreatePaymentData());
    }

    /**
     * @return array
     */
    protected function getCreatePaymentData()
    {
        return array(
             'channel' => 'other_shopsystem',
             'amount' => '100',
             'fee' => '10',
             'order_id' => '900001291100',
             'currency' => 'USD',
             'cart' => array(
                 array(
                     'name' => 'Some article',
                     'price' => '15',
                     'priceNetto' => '15',
                     'vatRate' => '10',
                     'quantity' => '3',
                     'description' => 'The new article',
                     'thumbnail' => 'https://someitem.com/thumbnail.jpg',
                     'sku' => '123',
                     'identifier' => '12345',
                 ),
                 array(
                     'name' => 'Some item',
                     'price' => '15',
                     'priceNetto' => '15',
                     'vatRate' => '10',
                     'quantity' => '3',
                     'description' => 'The new item in black',
                     'thumbnail' => 'https://someitem.com/thumbnail',
                     'sku' => '124',
                     'identifier' => '12346',
                 )
             ),
             'salutation' => 'mr',
             'first_name' => 'John',
             'last_name' => 'Doe',
             'city' => 'New York',
             'zip' => '10019',
             'street' => '5th Ave, 342',
             'country' => 'US',
             'email' => 'john@payever.de',
             'phone' => '+1 (800) 123756',
             'success_url' => 'https://www.you.shop.tld/callback/success/--PAYMENT-ID--/call_id/--CALL-ID--',
             'failure_url' => 'https://www.you.shop.tld/callback/failure/--PAYMENT-ID--/call_id/--CALL-ID--',
             'cancel_url' => 'https://www.you.shop.tld/callback/notice/--PAYMENT-ID--/call_id/--CALL-ID--',
             'notice_url' => 'https://www.you.shop.tld/callback/success/--PAYMENT-ID--/call_id/--CALL-ID--',
             'pending_url' => 'https://www.you.shop.tld/callback/pending/--PAYMENT-ID--/call_id/--CALL-ID--',
             'x_frame_host' => 'https://your.shop.tld,',
             'channel_set_id' => '',
             'payment_method' => '',
             'social_security_number' => '',
             'plugin_version' => '',
         );
    }

    /**
     * @param array $scheme
     */
    protected function assertActualRequestData($scheme)
    {
        $actualRequest = $this->getApiStubClient()->lastRequest();

        $this->assertNotEmpty($actualRequest, "Couldn't retrieve last request data from stub API server");

        foreach (['method', 'query', 'path'] as $key) {
            if (isset($scheme[$key])) {
                $this->assertEquals(
                    $scheme[$key],
                    $actualRequest[$key],
                    'RequestInterface: %s'
                );
            }
        }

        if (isset($scheme['body'])) {
            if (isset($scheme['body']['cart']) && is_array($scheme['body']['cart'])) {
                $scheme['body']['cart'] = json_encode($scheme['body']['cart']);
            }

            $this->assertEquals(
                array_filter($scheme['body']),
                array_filter($actualRequest['body'])
            );
        }
    }
}
