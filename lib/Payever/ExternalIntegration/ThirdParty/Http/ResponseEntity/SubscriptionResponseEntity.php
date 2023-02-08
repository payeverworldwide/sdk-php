<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;

/**
 * @method string getId()
 * @method string getAuthorizationId()
 * @method string getIntegration()
 * @method bool getConnected()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method SubscriptionActionEntity[] getActions()
 */
class SubscriptionResponseEntity extends ResponseEntity
{
    /**
     * @deprecated use $authorizationId instead
     *
     * @var string
     */
    protected $externalId;

    /**
     * Field value must be saved by user for further use in sync-related requests
     *
     * @var string
     */
    protected $authorizationId;

    /** @var string */
    protected $integration;

    /** @var bool */
    protected $connected;

    /** @var \DateTime|bool */
    protected $createdAt;

    /** @var \DateTime|bool */
    protected $updatedAt;

    /** @var SubscriptionActionEntity[] */
    protected $actions;

    /**
     * @deprecated use getAuthorizationId() instead
     *
     * @return string
     */
    public function getExternalId()
    {
        return null === $this->externalId
            ? $this->authorizationId
            : $this->externalId;
    }

    /**
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

    /**
     * @param string $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        if ($updatedAt) {
            $this->updatedAt = date_create($updatedAt);
        }

        return $this;
    }

    /**
     * @param array $actions
     * @return static
     */
    public function setActions($actions)
    {
        foreach ($actions as $plainAction) {
            $this->actions[] = new SubscriptionActionEntity($plainAction);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'authorizationId',
            'connected',
        ];
    }
}
