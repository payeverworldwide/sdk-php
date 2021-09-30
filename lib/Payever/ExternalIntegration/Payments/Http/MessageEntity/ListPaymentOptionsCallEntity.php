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

use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;
use Payever\ExternalIntegration\Core\Http\MessageEntity\ChannelSetEntity;

/**
 * This class represents List Payment Options Call Entity
 *
 * @method string           getAction()
 * @method string           getChannel()
 * @method ChannelSetEntity getChannelSet()
 * @method string           getType()
 * @method self             setAction(string $action)
 * @method self             setChannel(string $channel)
 * @method self             setType(string $type)
 */
class ListPaymentOptionsCallEntity extends CallEntity
{
    /** @var string $action */
    protected $action;

    /** @var string $channel */
    protected $channel;

    /** @var ChannelSetEntity $channelSet */
    protected $channelSet;

    /** @var string $type */
    protected $type;

    /**
     * Sets Channel Set
     *
     * @param array $channelSet
     */
    public function setChannelSet($channelSet)
    {
        $this->channelSet = new ChannelSetEntity($channelSet);
    }
}
