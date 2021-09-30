<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Plugins
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Base;

use Payever\ExternalIntegration\Core\Http\Response;

interface PluginsApiClientInterface
{
    /**
     * @return PluginRegistryInfoProviderInterface
     */
    public function getRegistryInfoProvider();

    /**
     * @return Response
     */
    public function registerPlugin();

    /**
     * @return Response
     */
    public function unregisterPlugin();

    /**
     * @param string $commandId
     * @return Response
     */
    public function acknowledgePluginCommand($commandId);

    /**
     * @param int|null $fromTimestamp
     * @return Response
     */
    public function getCommands($fromTimestamp = null);

    /**
     * Retrieve the latest plugin info for current CMS.
     *
     * @return Response
     */
    public function getLatestPluginVersion();
}
