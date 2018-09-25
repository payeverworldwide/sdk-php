<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\Authorization\Token;
use Payever\ExternalIntegration\Payments\Api;
use Payever\ExternalIntegration\Payments\Configuration;
use Payever\Tests\Bootstrap\TestCase;

/**
 * Class ApiTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Api
 *
 * @package Payever\ExternalIntegration\Payments
 */
class ApiTest extends TestCase
{
    /**
     * @var Api
     */
    private $api;

    public function setUp()
    {
        parent::setUp();

        $config = $this->getMockBuilder('Payever\ExternalIntegration\Payments\Configuration')
            ->enableProxyingToOriginalMethods()
            ->getMockForAbstractClass();

        $config->setSlug('stub')
            ->setClientId('stub')
            ->setClientSecret('stub')
            ->setApiMode(Configuration::MODE_SANDBOX);

        $token = $this->getMockBuilder('Payever\ExternalIntegration\Core\Authorization\Token')
            ->enableProxyingToOriginalMethods()
            ->getMockForAbstractClass();

        $client = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\CurlClient')
            ->setMethods(array('execute'))
            ->getMock();

        $token->load(array(
            'created_at' => time(),
            'updated_at' => time(),
            'access_token' => 'stub_access_token',
            'refresh_token' => 'stub_refresh_token',
            'scope' => Token::SCOPE_CREATE_PAYMENT,
        ));

        $tokens = $this->getMockBuilder('Payever\ExternalIntegration\Core\Authorization\TokenList')
            ->enableProxyingToOriginalMethods()
            ->getMockForAbstractClass();

        $this->api = $this->getMockBuilder('Payever\ExternalIntegration\Payments\Api')
            ->enableProxyingToOriginalMethods()
            ->disableOriginalConstructor()
            ->setMethods(array('getConfiguration', 'getToken', 'getTokens', 'getClient'))
            ->getMockForAbstractClass();

        $this->api->expects($this->any())
            ->method('getToken')
            ->willReturn($token);

        $this->api->expects($this->any())
            ->method('getConfiguration')
            ->willReturn($config);

        $this->api->expects($this->any())
            ->method('getClient')
            ->willReturn($client);

        $this->api->expects($this->any())
            ->method('getTokens')
            ->willReturn($tokens);

        $this->api->setConfiguration($config);
    }

    /**
     * @param string $mode
     * @param string $expectedUrl
     *
     * @dataProvider modeUrlDataProvider
     *
     * @throws \ReflectionException
     */
    public function testModeUrl($mode, $expectedUrl)
    {
        $this->api->getConfiguration()->setApiMode($mode);

        $baseUrl = $this->invokeProtectedMethod($this->api, 'getBaseUrl');

        $this->assertEquals($expectedUrl, $baseUrl);
    }

    /**
     * @return array
     */
    public function modeUrlDataProvider()
    {
        return array(
            array(Configuration::MODE_SANDBOX, "https://sandbox.payever.de/"),
            array(Configuration::MODE_LIVE, "https://mein.payever.de/"),
            array('', "https://mein.payever.de/"),
            array(null, "https://mein.payever.de/"),
        );
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Api::getGrandTypes
     */
    public function testGrantTypes()
    {
        $this->assertEquals(
            array('refresh_token', 'http://www.payever.de/api/payment'),
            Api::getGrandTypes()
        );
    }


    /**
     * @covers \Payever\ExternalIntegration\Payments\Api::isLoaded()
     *
     * @dataProvider isLoadedCasesDataProvider
     *
     * @throws \Exception
     */
    public function testIsLoaded($method, $value, $isLoaded)
    {
        $configuration = $this->api->getConfiguration();

        $configuration->{$method}($value);

        self::assertEquals($isLoaded, $this->api->isLoaded());
    }

    /**
     * @return array
     */
    public function isLoadedCasesDataProvider()
    {
        return array(
            'no client_id' => array('setClientId', null, false),
            'no client_secret' => array('setClientSecret', '', false),
            'no slug' => array('setSlug', 0, false),
            'with slug' => array('setSlug', 'good', true),
        );
    }
}
