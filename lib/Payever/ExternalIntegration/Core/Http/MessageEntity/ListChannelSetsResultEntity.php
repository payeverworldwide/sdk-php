<?php
/**
 * This class represents List Channel Sets Result Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

/**
 * This class represents List Channel Sets Result Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method int                getId()
 * @method string             getChannelType()
 * @method ChannelSetEntity[] getChannelSets()
 * @method bool               getEnabled()
 * @method self               setId()
 * @method self               setChannelType()
 */
class ListChannelSetsResultEntity extends ResultEntity
{
    /** @var int $id */
    protected $id;

    /** @var string $channelType */
    protected $channelType;

    /** @var ChannelSetEntity[] $channelSets */
    protected $channelSets;

    /** @var bool $enabled */
    protected $enabled;

    /**
     * Sets Channel Sets
     *
     * @param array $channelSets
     */
    public function setChannelSets($channelSets)
    {
        $this->channelSets = array();

        foreach ($channelSets as $channelSet) {
            $this->channelSets[] = new ChannelSetEntity($channelSet);
        }
    }

    /**
     * Sets Enabled
     *
     * @param string $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = filter_var($enabled, FILTER_VALIDATE_BOOLEAN);
    }
}
