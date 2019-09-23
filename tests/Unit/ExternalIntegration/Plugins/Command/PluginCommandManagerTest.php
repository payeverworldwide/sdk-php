<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Core\Http\Response;
use Payever\ExternalIntegration\Plugins\Command\PluginCommandExecutorInterface;
use Payever\ExternalIntegration\Plugins\Command\PluginCommandManager;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\CommandsResponseEntity;
use Payever\ExternalIntegration\Plugins\PluginsApiClient;
use Payever\Tests\Bootstrap\Plugins\PluginRegistryIntoProvider;
use Payever\Tests\Bootstrap\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class PluginCommandManagerTest extends TestCase
{
    /** @var PluginCommandManager */
    private $pluginCommandManager;

    /** @var PluginsApiClient|MockObject */
    private $pluginApiClient;

    /** @var PluginCommandExecutorInterface|MockObject */
    private $pluginCommandExecutor;

    protected function setUp()
    {
        $this->pluginApiClient = $this->getMockBuilder(PluginsApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->pluginCommandExecutor = $this->getMockForAbstractClass(PluginCommandExecutorInterface::class);

        $this->pluginCommandManager = new PluginCommandManager(
            $this->pluginApiClient,
            $this->pluginCommandExecutor,
            new PluginRegistryIntoProvider()
        );
    }

    public function testExecutePluginCommands()
    {
        $commands = [
            [
                '_id' => 'stub-command-id',
                'name' => PluginCommandNameEnum::SET_LIVE_HOST,
                'value' => 'https://some.host.com',
            ]
        ];

        $commandsResponseEntity = new CommandsResponseEntity($commands);
        $response = new Response();
        $response->setResponseEntity($commandsResponseEntity);

        $this->pluginApiClient->expects($this->once())
            ->method('getCommands')
            ->willReturn($response);

        $this->pluginCommandExecutor->expects($this->once())
            ->method('executeCommand')
            ->with($commands[0]['name'], $commands[0]['value']);

        $this->pluginApiClient->expects($this->once())
            ->method('acknowledgePluginCommand')
            ->with($commands[0]['_id']);

        $this->pluginCommandManager->executePluginCommands();
    }
}
