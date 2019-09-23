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

use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;

interface PluginRegistryInfoProviderInterface
{
    /**
     * @return string
     */
    public function getPluginVersion();

    /**
     * @return string
     */
    public function getCmsVersion();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getChannel();

    /**
     * @return string[]
     * @see PluginCommandNameEnum
     */
    public function getSupportedCommands();

    /**
     * @return string|null
     */
    public function getCommandEndpoint();

    /**
     * @return string[]
     */
    public function getBusinessIds();
}
