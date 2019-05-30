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

    /**
     * @return array
     */
    public function modeUrlDataProvider()
    {
        return array(
            array(ClientConfiguration::API_MODE_SANDBOX, "https://sandbox.payever.de/"),
            array(ClientConfiguration::API_MODE_LIVE, "https://mein.payever.de/"),
            array('', "https://mein.payever.de/"),
            array(null, "https://mein.payever.de/"),
        );
    }
}
