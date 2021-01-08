<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;

/**
 * Class SubscriptionResponseEntity
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getId()
 * @method string getExternalId()
 * @method bool getConnected()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method SubscriptionActionEntity[] getActions()
 */
class SubscriptionResponseEntity extends ResponseEntity
{
    /**
     * Field value must be saved by user for further use in sync-related requests
     *
     * @var string
     */
    protected $externalId;

    /** @var bool */
    protected $connected;

    /** @var \DateTime|bool */
    protected $createdAt;

    /** @var \DateTime|bool */
    protected $updatedAt;

    /** @var SubscriptionActionEntity[] */
    protected $actions;

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = date_create($updatedAt);
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
        return array(
            'externalId',
            'connected',
        );
    }
}
