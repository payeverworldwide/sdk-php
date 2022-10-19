<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Cart Item Entity
 *
 * @method string           getName()
 * @method string           getType()
 * @method string           getSource()
 * @method string           getChannelSetId()
 * @method self             setName(string $name)
 * @method self             setType(string $type)
 * @method self             setSource(string $source)
 * @method self             setChannelSetId(string $channelSetId)
 */
class ChannelEntity extends MessageEntity
{
    /** @var string $name */
    protected $name;

    /** @var string $type */
    protected $type;

    /** @var string $source */
    protected $source;

    /** @var integer channelSetId */
    protected $channelSetId;

    /**
     * {@inheritdoc}
     */
    public function toArray($object = null)
    {
        return $object ? get_object_vars($object) : get_object_vars($this);
    }
}
