<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  ResponseEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;

class CommandsResponseEntity extends ResponseEntity
{
    /** @var PluginCommandEntity[] */
    protected $commands = [];

    /**
     * @inheritDoc
     */
    public function load($data)
    {
        if (is_array($data)) {
            foreach ($data as $plainCommand) {
                $this->commands[] = new PluginCommandEntity($plainCommand);
            }
        }
    }

    /**
     * @return PluginCommandEntity[]
     */
    public function getCommands()
    {
        return $this->commands;
    }
}
