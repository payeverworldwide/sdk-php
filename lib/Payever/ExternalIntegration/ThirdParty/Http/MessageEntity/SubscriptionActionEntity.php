<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;

/**
 * @method string getName()
 * @method string getUrl()
 * @method string getMethod()
 * @method self setName(string $name)
 * @method self setUrl(string $url)
 * @method self setMethod(string $httpMethod)
 */
class SubscriptionActionEntity extends MessageEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * @var string
     * @see ActionEnum
     */
    protected $name;

    /** @var string */
    protected $url;

    /** @var string */
    protected $method;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'name',
            'url',
            'method',
        ];
    }
}
