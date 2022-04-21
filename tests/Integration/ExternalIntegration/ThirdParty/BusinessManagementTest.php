<?php

namespace Payever\Tests\Integration\ExternalIntegration\ThirdParty;

class BusinessManagementTest extends ThirdPartyBaseTest
{
    public function testGetBusiness()
    {
        $business = $this->thirdPartyApiClient->getBusinessRequest();

        $configuration = $this->thirdPartyApiClient->getConfiguration();

        $this->assertEquals($configuration->getBusinessUuid(), $business->getResponseEntity()->getName());

        $this->assertActualRequestData([
            'path' => sprintf(
                '/api/business/%s/plugins',
                $this->thirdPartyApiClient->getConfiguration()->getBusinessUuid()
            ),
            'method' => 'GET',
        ]);
    }
}
