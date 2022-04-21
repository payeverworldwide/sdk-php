<?php

namespace Payever\Tests\Integration\ExternalIntegration\Plugins;

use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\CommandsResponseEntity;
use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\PluginRegistryResponseEntity;
use Payever\ExternalIntegration\Plugins\PluginsApiClient;
use Payever\Tests\Bootstrap\Plugin\ClientConfigurationProvider;
use Payever\Tests\Bootstrap\Plugins\PluginRegistryIntoProvider;
use Payever\Tests\Integration\ExternalIntegration\Core\ApiClientBaseTest;

class PluginsApiClientTest extends ApiClientBaseTest
{
    /** @var PluginsApiClient */
    protected $pluginsApiClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pluginsApiClient = new PluginsApiClient(
            new PluginRegistryIntoProvider(),
            ClientConfigurationProvider::getClientConfiguration()
        );
    }

    public function testRegister()
    {
        $response = $this->pluginsApiClient->registerPlugin();

        $this->assertInstanceOf(PluginRegistryResponseEntity::class, $response->getResponseEntity());

        $infoProvider = $this->pluginsApiClient->getRegistryInfoProvider();

        $this->assertActualRequestData([
            'pluginVersion' => $infoProvider->getPluginVersion(),
            'cmsVersion' => $infoProvider->getCmsVersion(),
            'channel' => $infoProvider->getChannel(),
            'host' => $infoProvider->getHost(),
            'supportedCommands' => $infoProvider->getSupportedCommands(),
            'businessIds' => $infoProvider->getBusinessIds(),
            'commandEndpoint' => $infoProvider->getCommandEndpoint(),
        ]);
    }

    public function testAcknowledgeCommand()
    {
        $this->pluginsApiClient->registerPlugin();
        $this->pluginsApiClient->acknowledgePluginCommand('8e2ec308-3500-4374-a0e5-43fbc39a8ddf');

        $this->assertActualRequestData([]);
    }

    public function testUnregister()
    {
        $this->pluginsApiClient->registerPlugin();
        $response = $this->pluginsApiClient->unregisterPlugin();

        $this->assertInstanceOf(PluginRegistryResponseEntity::class, $response->getResponseEntity());

        $infoProvider = $this->pluginsApiClient->getRegistryInfoProvider();

        $this->assertActualRequestData([
            'channel' => $infoProvider->getChannel(),
            'host' => $infoProvider->getHost(),
        ]);
    }

    public function testGetCommands()
    {
        /** @var CommandsResponseEntity $commands */
        $commandsEntity = $this->pluginsApiClient->getCommands()->getResponseEntity();
        $commands = $commandsEntity->getCommands();

        $this->assertEquals($commands[0]->getName(), 'set-sandbox-host');
        $this->assertEquals($commands[0]->getValue(), 'https://stub-sandbox-url.com');

        $this->assertEquals($commands[1]->getName(), 'set-live-host');
        $this->assertEquals($commands[1]->getValue(), 'https://stub-live-url.com');
    }
}
