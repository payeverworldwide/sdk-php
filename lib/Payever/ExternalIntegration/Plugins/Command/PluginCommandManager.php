<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Plugins\Base\PluginRegistryInfoProviderInterface;
use Payever\ExternalIntegration\Plugins\Base\PluginsApiClientInterface;
use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\CommandsResponseEntity;

class PluginCommandManager
{
    /** @var int|null */
    private $lastCommandTimestamp;

    /** @var PluginsApiClientInterface */
    private $pluginsApiClient;

    /** @var PluginCommandExecutorInterface */
    private $commandExecutor;

    /** @var PluginRegistryInfoProviderInterface */
    private $registryInfoProvider;

    public function __construct(
        PluginsApiClientInterface $pluginsApiClient,
        PluginCommandExecutorInterface $commandExecutor,
        PluginRegistryInfoProviderInterface $registryInfoProvider,
        $lastCommandTimestamp = null
    ) {
        $this->pluginsApiClient = $pluginsApiClient;
        $this->commandExecutor = $commandExecutor;
        $this->registryInfoProvider = $registryInfoProvider;
        $this->lastCommandTimestamp = $lastCommandTimestamp;
    }

    /**
     * Gets up to date commands and executes them
     *
     * @throws \Exception - bubbles up anything thrown by API or CommandExecutor
     */
    public function executePluginCommands()
    {
        $commandsResponse = $this->pluginsApiClient->getCommands($this->lastCommandTimestamp);
        /** @var CommandsResponseEntity $commandsResponseEntity */
        $commandsResponseEntity = $commandsResponse->getResponseEntity();
        $commandsList = $commandsResponseEntity->getCommands();

        foreach ($commandsList as $commandEntity) {
            if ($this->isCommandSupported($commandEntity->getName())) {
                $this->commandExecutor->executeCommand($commandEntity->getName(), $commandEntity->getValue());
                $this->pluginsApiClient->acknowledgePluginCommand($commandEntity->getId());
            }
        }
    }

    /**
     * @param string $commandName
     * @return bool
     */
    private function isCommandSupported($commandName)
    {
        return in_array($commandName, $this->registryInfoProvider->getSupportedCommands());
    }
}
