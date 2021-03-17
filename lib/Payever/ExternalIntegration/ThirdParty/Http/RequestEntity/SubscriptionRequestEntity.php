<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  RequestEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;

/**
 * @method string getExternalId()
 * @method string getThirdPartyName()
 * @method string getBusinessUuid()
 * @method SubscriptionActionEntity[] getActions()
 * @method self setExternalId(string $externalId)
 * @method self setThirdPartyName(string $name)
 * @method self setBusinessUuid(string $businessUuid)
 * @method self setActions(SubscriptionActionEntity[] $actions)
 */
class SubscriptionRequestEntity extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /** @var string */
    protected $businessUuid;

    /** @var string */
    protected $externalId;

    /**
     * @see \Payever\ExternalIntegration\Core\Enum\ChannelSet
     *
     * @var string
     */
    protected $thirdPartyName;

    /** @var SubscriptionActionEntity[] */
    protected $actions = [];

    /**
     * @param SubscriptionActionEntity $actionEntity
     *
     * @return static
     */
    public function addAction(SubscriptionActionEntity $actionEntity)
    {
        $this->actions[] = $actionEntity;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'businessUuid',
            'thirdPartyName',
        ];
    }
}
