<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Command
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;

interface PluginCommandExecutorInterface
{
    /**
     * @param PluginCommandEntity $command
     *
     * @return bool
     *
     * @throws \Exception when command could not be executed at the moment
     */
    public function executeCommand(PluginCommandEntity $command);
}
