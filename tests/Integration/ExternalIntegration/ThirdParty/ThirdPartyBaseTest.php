<?php

namespace Payever\Tests\Integration\ExternalIntegration\ThirdParty;

use Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Integration\ExternalIntegration\Core\ApiClientBaseTest;

abstract class ThirdPartyBaseTest extends ApiClientBaseTest
{
    /** @var ThirdPartyApiClient */
    protected $thirdPartyApiClient;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->thirdPartyApiClient = new ThirdPartyApiClient(
            ClientConfigurationProvider::getClientConfiguration()
        );
    }
}
