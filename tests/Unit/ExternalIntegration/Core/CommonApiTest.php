<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 2019-04-15
 * Time: 16:20
 */

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\CommonApiClient;
use PHPUnit\Framework\TestCase;

/**
 * @see \Payever\ExternalIntegration\Core\ClientConfiguration
 */
class CommonApiTest extends TestCase
{
    /** @var ClientConfiguration */
    private $config;

    /** @var CommonApiClient */
    private $commonApi;

    protected function setUp()
    {
        parent::setUp();

        $config = new ClientConfiguration();

        $config->setApiMode(ClientConfiguration::API_MODE_SANDBOX)
            ->setBusinessUuid('stub')
            ->setClientSecret('stub')
            ->setClientId('stub')
        ;

        $this->config = $config;
        $this->commonApi = new CommonApiClient($this->config);
    }

    /**
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::getBaseUrl
     *
     * @param string $mode
     * @param string $expectedUrl
     *
     * @dataProvider modeUrlDataProvider
     *
     * @throws \ReflectionException
     */
    public function testGetBaseUrl($mode, $expectedUrl)
    {
        $this->config->setApiMode($mode);

        $baseUrl = $this->commonApi->getBaseUrl();

        $this->assertEquals($expectedUrl, $baseUrl);
    }

    public function testCustomBaseUrl()
    {
        $customSandboxUrl = 'https://sandbox.some.domain/';
        $customLiveUrl = 'https://live.some.domain/';

        $this->config->setCustomSandboxUrl($customSandboxUrl)->setApiMode(ClientConfiguration::API_MODE_SANDBOX);
        $this->assertEquals($customSandboxUrl, $this->commonApi->getBaseUrl());

        $this->config->setCustomLiveUrl($customLiveUrl)->setApiMode(ClientConfiguration::API_MODE_LIVE);
        $this->assertEquals($customLiveUrl, $this->commonApi->getBaseUrl());
    }

    /**
     * @return array
     */
    public function modeUrlDataProvider()
    {
        return array(
            array(ClientConfiguration::API_MODE_SANDBOX, "https://proxy.staging.devpayever.com/"),
            array(ClientConfiguration::API_MODE_LIVE, "https://proxy.payever.org/"),
            array('', "https://proxy.payever.org/"),
            array(null, "https://proxy.payever.org/"),
        );
    }
}
