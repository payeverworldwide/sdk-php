<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Enum
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

class PluginCommandNameEnum extends EnumerableConstants
{
    const SET_SANDBOX_HOST = 'set-sandbox-host';

    const SET_LIVE_HOST = 'set-live-host';

    const SET_COMMAND_POLLING_DELAY = 'set-command-polling-delay';

    const NOTIFY_NEW_PLUGIN_VERSION = 'notify-new-plugin-version';

    const SET_API_VERSION = 'set-api-version';
}
