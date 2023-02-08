<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Call Entity
 *
 * @method string getId()
 * @method string getStatus()
 * @method string getBusinessId()
 * @method \DateTime|false getCreatedAt()
 * @method self setId(string $id)
 * @method self setStatus(string $status)
 * @method self setBusinessId(string $businessId)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
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
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        if ($createdAt) {
            $this->createdAt = date_create($createdAt);
        }

        return $this;
    }
}
