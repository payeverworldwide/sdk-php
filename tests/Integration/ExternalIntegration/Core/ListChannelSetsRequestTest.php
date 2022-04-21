<?php

namespace Payever\Tests\Integration\ExternalIntegration\Core;

class ListChannelSetsRequestTest extends ApiClientBaseTest
{
    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listChannelSetsRequest()
     *
     * @throws \Exception
     */
    public function testListChannelSetsRequestSuccess()
    {
        $slug = $this->commonApiClient->getConfiguration()->getBusinessUuid();
        $response = $this->commonApiClient->listChannelSetsRequest($slug);

        self::assertTrue($response->getResponseEntity()->isValid());

        $this->assertActualRequestData(array(
            'path' => sprintf('/api/shop/oauth/%s/channel-sets', $slug),
            'method' => 'GET',
        ));
    }

    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listChannelSetsRequest()
     */
    public function testListChannelSetsRequestFailure()
    {
        $this->expectException(\Exception::class);
        $this->commonApiClient->listChannelSetsRequest('');
    }
}
