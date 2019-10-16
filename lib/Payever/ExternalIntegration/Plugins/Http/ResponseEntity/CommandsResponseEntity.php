<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;

class CommandsResponseEntity extends ResponseEntity
{
    /** @var PluginCommandEntity[] */
    protected $commands = array();

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
