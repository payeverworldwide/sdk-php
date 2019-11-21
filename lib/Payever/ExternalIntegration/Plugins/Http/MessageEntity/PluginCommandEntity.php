<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;

/**
 * @method string getId()
 * @method string getName()
 * @method string getValue()
 * @method string|null getChannelType()
 * @method string|null getMinCmsVersion()
 * @method string|null getMaxCmsVersion()
 * @method array getMetadata()
 */
class PluginCommandEntity extends MessageEntity
{
    /** @var string */
    protected $id;

    /**
     * @var string
     * @see PluginCommandNameEnum
     */
    protected $name;

    /** @var string */
    protected $value;

    protected $channelType;

    /** @var string */
    protected $minCmsVersion;

    /** @var string */
    protected $maxCmsVersion;

    /**
     * Additional data with specific for each command fields
     *
     * @var array
     */
    protected $metadata = array();

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getMeta($key)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function setMeta($key, $value)
    {
        $this->metadata[$key] = $value;

        return $this;
    }
}
