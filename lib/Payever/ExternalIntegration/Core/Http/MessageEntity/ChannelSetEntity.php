<?php

/**
 * PHP version 5.4 and 7
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
 * This class represents Channel Set Entity
 *
 * @method int getId()
 * @method string getName()
 * @method string getSlug()
 * @method bool getConfigured()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method string getDiscr()
 * @method self setId(string $id)
 * @method self setName(string $name)
 * @method self setSlug(string $slug)
 * @method self setDiscr(string $discr)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class ChannelSetEntity extends MessageEntity
{
    /** @var int $id */
    protected $id;

    /** @var string $name */
    protected $name;

    /** @var string $slug */
    protected $slug;

    /** @var bool $configured */
    protected $configured;

    /** @var \DateTime|bool $createdAt */
    protected $createdAt;

    /** @var \DateTime|bool $updatedAt */
    protected $updatedAt;

    /** @var string $discr */
    protected $discr;

    /**
     * Sets Configured
     *
     * @param string $configured
     */
    public function setConfigured($configured)
    {
        $this->configured = filter_var($configured, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Sets Created At
     *
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);
    }

    /**
     * Sets Updated At
     *
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = date_create($updatedAt);
    }
}
