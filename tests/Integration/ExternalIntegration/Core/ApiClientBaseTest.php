<?php

namespace Payever\Tests\Integration\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\CommonApiClient;
use Payever\Stub\Client;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Bootstrap\TestCase;

abstract class ApiClientBaseTest extends TestCase
{
    /** @var CommonApiClient $commonApiClient */
    protected $commonApiClient;

    /** @var Client */
    protected $stubClient;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->commonApiClient = new CommonApiClient(
            ClientConfigurationProvider::getClientConfiguration()
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->getApiStubClient()->clearRequestStorage();
        $this->getApiStubClient()->resetConfig();
    }

    protected function createStubClient()
    {
        if (!defined('STUB_SERVER_HOST') || !defined('STUB_SERVER_PORT')) {
            exit("FATAL: You must define STUB_SERVER_HOST and STUB_SERVER_PORT constants in phpunit.xml" . PHP_EOL);
        }

        return new Client(intval(STUB_SERVER_PORT) + 1, STUB_SERVER_HOST);
    }

    /**
     * @return Client
     */
    protected function getApiStubClient()
    {
        if (is_null($this->stubClient)) {
            $this->stubClient = $this->createStubClient();
        }

        return $this->stubClient;
    }

    /**
     * @param array $scheme
     */
    protected function assertActualRequestData($scheme)
    {
        $actualRequest = $this->getApiStubClient()->lastRequest();

        if (isset($actualRequest['body']) && is_string($actualRequest['body'])) {
            $actualRequest['body'] = json_decode($actualRequest['body'], true);
        }

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
