<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  RequestEntity
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;

/**
 * @method self setPluginVersion(string $pluginVersion)
 * @method self setCmsVersion(string $cmsVersion)
 * @method self setChannel(string $channel)
 * @method self setHost(string $host)
 * @method self setSupportedCommands(string[] $commands)
 * @method self setCommandEndpoint(string $endpoint)
 * @method self setBusinessIds(string[] $ids)
 */
class PluginRegistryRequestEntity extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * @required only for registration
     * @var string
     */
    protected $pluginVersion;

    /**
     * @required only for registration
     * @var string
     */
    protected $cmsVersion;

    /**
     * @required
     * @var string
     * @see ChannelSet
     */
    protected $channel;

    /**
     * @required
     * @var string
     */
    protected $host;

    /**
     * @var array
     * @see PluginCommandNameEnum
     */
    protected $supportedCommands;

    /** @var string */
    protected $commandEndpoint;

    /** @var string[] */
    protected $businessIds;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'channel',
            'host',
        ];
    }
}
