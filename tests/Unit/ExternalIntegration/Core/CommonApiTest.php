<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\Authorization\OauthTokenList;
use Payever\ExternalIntegration\Core\Base\ClientConfigurationInterface;
use Payever\ExternalIntegration\Core\Base\HttpClientInterface;
use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;
use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\CommonApiClient;
use Payever\ExternalIntegration\Core\Http\Client\CurlClient;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * @see \Payever\ExternalIntegration\Core\ClientConfiguration
 */
class CommonApiTest extends TestCase
{
    /** @var ClientConfiguration */
    private $config;

    /** @var CommonApiClient */
    private $commonApi;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $config = new ClientConfiguration();

        $config->setApiMode(ClientConfiguration::API_MODE_SANDBOX)
            ->setBusinessUuid('stub')
            ->setClientSecret('stub')
            ->setClientId('stub');

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

    public function testSetConfiguration()
    {
        /** @var MockObject|ClientConfigurationInterface $configuration */
        $configuration = $this->getMockBuilder(ClientConfigurationInterface::class)->getMock();
        $this->commonApi->setConfiguration($configuration);
        $this->assertNotEmpty($this->commonApi->getTokens());
    }

    public function testSetHttpClient()
    {
        /** @var MockObject|HttpClientInterface $httpClient */
        $httpClient = $this->getMockBuilder(HttpClientInterface::class)->getMock();
        /** @var MockObject|LoggerInterface $logger */
        $logger = $this->getMockBuilder(LoggerInterface::class)->getMock();
        $this->config->setLogger($logger);
        $logger->expects($this->once())->method('debug');
        $this->commonApi->setHttpClient($httpClient);
    }

    public function testSetHttpClientRequestFailureLogLevel()
    {
        /** @var MockObject|CurlClient $httpClient */
        $httpClient = $this->getMockBuilder(CurlClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->commonApi->setHttpClient($httpClient);
        $httpClient->expects($this->once())->method('setLogLevel');
        $this->commonApi->setHttpClientRequestFailureLogLevel(LogLevel::NOTICE);
    }

    public function testSetHttpClientRequestFailureLogLevelOnce()
    {
        /** @var MockObject|CurlClient $httpClient */
        $httpClient = $this->getMockBuilder(CurlClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->commonApi->setHttpClient($httpClient);
        $httpClient->expects($this->once())->method('setLogLevelOnce');
        $this->commonApi->setHttpClientRequestFailureLogLevelOnce(LogLevel::NOTICE);
    }

    public function testGetTokenCaseRefresh()
    {
        /** @var MockObject|OauthTokenList $oauthTokenList */
        $oauthTokenList = $this->getMockBuilder(OauthTokenList::class)->getMock();
        $oauthTokenList->expects($this->once())
            ->method('load')
            ->willReturn($oauthTokenList);
        /** @var MockObject|HttpClientInterface $httpClient */
        $httpClient = $this->getMockBuilder(HttpClientInterface::class)->getMock();
        $this->commonApi = new CommonApiClient($this->config, $oauthTokenList, $httpClient);
        $oauthTokenList->expects($this->once())
            ->method('get')
            ->willReturn($token = $this->getMockBuilder(OauthTokenInterface::class)->getMock());
        $token->expects($this->any())
            ->method('isExpired')
            ->willReturn(true);
        $token->expects($this->any())
            ->method('isRefreshable')
            ->willReturn(true);
        $httpClient->expects($this->once())
            ->method('execute')
            ->willReturn($response = $this->getMockBuilder(ResponseInterface::class)->getMock());
        $response->expects($this->once())
            ->method('getResponseEntity')
            ->willReturn($responseEntity = $this->getMockBuilder(ResponseEntity::class)->getMock());
        $responseEntity->expects($this->once())
            ->method('toArray')
            ->willReturn(['some' => 'data']);
        $token->expects($this->once())
            ->method('load')
            ->willReturn($token);
        $token->expects($this->once())
            ->method('getParams')
            ->willReturn(['some' => 'data']);
        $this->commonApi->getToken();
    }

    /**
     * @return array
     */
    public function modeUrlDataProvider()
    {
        return [
            [ClientConfiguration::API_MODE_SANDBOX, 'https://proxy.staging.devpayever.com/'],
            [ClientConfiguration::API_MODE_LIVE, 'https://proxy.payever.org/'],
            ['', 'https://proxy.payever.org/'],
            [null, 'https://proxy.payever.org/'],
        ];
    }
}
