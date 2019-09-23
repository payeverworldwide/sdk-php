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

interface PluginCommandExecutorInterface
{
    /**
     * @param string $commandName {@see \Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum }
     * @param string $commandValue
     * @return bool
     *
     * @throws \Exception when command could not be executed at the moment
     */
    public function executeCommand($commandName, $commandValue);
}
