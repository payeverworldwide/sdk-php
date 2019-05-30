<?php
/**
 * This class represents Call Entity
 *
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Call Entity
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string getId()
 * @method string getStatus()
 * @method string getBusinessId()
 * @method \DateTime|false getCreatedAt()
 * @method self setId(string $id)
 * @method self setStatus(string $status)
 * @method self setBusinessId(string $businessId)
 */
class CallEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $status */
    protected $status;

    /** @var string $businessId */
    protected $businessId;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /**
     * Sets Created At
     *
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);
    }
}
