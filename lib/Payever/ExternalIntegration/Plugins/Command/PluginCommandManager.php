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

use Payever\ExternalIntegration\Plugins\Base\PluginsApiClientInterface;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;
use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\CommandsResponseEntity;
use Psr\Log\LoggerInterface;

class PluginCommandManager
{
    /** @var PluginsApiClientInterface */
    private $pluginsApiClient;

    /** @var PluginCommandExecutorInterface */
    private $commandExecutor;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        PluginsApiClientInterface $pluginsApiClient,
        PluginCommandExecutorInterface $commandExecutor,
        LoggerInterface $logger
    ) {
        $this->pluginsApiClient = $pluginsApiClient;
        $this->commandExecutor = $commandExecutor;
        $this->logger = $logger;
    }

    /**
     * Gets up to date commands and executes them
     *
     * @param int|null $lastCommandTimestamp
     *
     * @throws \Exception - bubbles up anything thrown by API or CommandExecutor
     */
    public function executePluginCommands($lastCommandTimestamp = null)
    {
        $commandsResponse = $this->pluginsApiClient->getCommands($lastCommandTimestamp);
        /** @var CommandsResponseEntity $commandsResponseEntity */
        $commandsResponseEntity = $commandsResponse->getResponseEntity();
        $commandsList = $commandsResponseEntity->getCommands();

        foreach ($commandsList as $commandEntity) {
            if ($this->isCommandSupported($commandEntity)) {
                $this->logger->info(
                    sprintf(
                        'Executing plugin command %s with value %s',
                        $commandEntity->getName(),
                        $commandEntity->getValue()
                    )
                );
                $this->commandExecutor->executeCommand($commandEntity);
                $this->pluginsApiClient->acknowledgePluginCommand($commandEntity->getId());
            } else {
                $this->logger->info(
                    sprintf(
                        'Plugin command %s with value %s is not supported',
                        $commandEntity->getName(),
                        $commandEntity->getValue()
                    )
                );
            }
        }
    }

    /**
     * @param PluginCommandEntity $commandEntity
     *
     * @return bool
     */
    private function isCommandSupported(PluginCommandEntity $commandEntity)
    {
        $infoProvider = $this->pluginsApiClient->getRegistryInfoProvider();

        if (!in_array($commandEntity->getName(), $infoProvider->getSupportedCommands())) {
            return false;
        }

        if ($commandEntity->getName() === PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION
            && version_compare($commandEntity->getValue(), $infoProvider->getPluginVersion(), '<=')
        ) {
            return false;
        }

        return true;
    }
}