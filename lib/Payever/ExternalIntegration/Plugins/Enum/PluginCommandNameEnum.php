<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

class PluginCommandNameEnum extends EnumerableConstants
{
    const SET_SANDBOX_HOST = 'set-sandbox-host';

    const SET_LIVE_HOST = 'set-live-host';

    const SET_COMMAND_POLLING_DELAY = 'set-command-polling-delay';
}
