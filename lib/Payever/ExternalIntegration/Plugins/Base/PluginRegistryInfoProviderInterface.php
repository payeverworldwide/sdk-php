<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Base;

use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;

interface PluginRegistryInfoProviderInterface
{
    /**
     * @return string - MUST return a semver (https://semver.org/) value of plugin version
     */
    public function getPluginVersion();

    /**
     * @return string - MUST return a semver (https://semver.org/) value of CMS version
     */
    public function getCmsVersion();

    /**
     * @return string - hostname of a CMS installation
     */
    public function getHost();

    /**
     * @return string
     * @see ChannelSet
     */
    public function getChannel();

    /**
     * @return string[]
     * @see PluginCommandNameEnum
     */
    public function getSupportedCommands();

    /**
     * @return string|null - A URL which must be called whenever new command created.
     *                       Useful when there is no cron schedule available in the user's system.
     *                       NOTE: It will be a POST request with no payload, you still need to poll for suitable commands.
     *                       NOTE: Trust no one - Please include some kind of secret token in this URL and check if it is valid when handling this request.
     */
    public function getCommandEndpoint();

    /**
     * @return string[] - List of business UUID's used by plugin
     */
    public function getBusinessIds();
}
