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
 * This class represents Payment Data Entity
 *
 * @method \DateTime|false  getBirthdate()
 * @method bool             getConditionsAccepted()
 * @method string           getRiskSessionId()
 * @method string           getFrontendFinishUrl()
 * @method string           getFrontendCancelUrl()
 * @method bool             getForceRedirect()
 * @method string           getFloor()
 * @method string           getDoor()
 * @method string           getBlock()
 * @method self             setConditionsAccepted(bool $conditionsAccepted)
 * @method self             setRiskSessionId(string $riskSessionId)
 * @method self             setFrontendFinishUrl(string $frontendFinishUrl)
 * @method self             setFrontendCancelUrl(string $frontendCancelUrl)
 * @method self             setFloor(string $floor)
 * @method self             setDoor(string $door)
 * @method self             setBlock(string $block)
 */
class PaymentDataEntity extends MessageEntity
{
    /** @var \DateTime|bool $birthdate */
    protected $birthdate;

    /** @var bool $conditionsAccepted */
    protected $conditionsAccepted;

    /** @var string $riskSessionId */
    protected $riskSessionId;

    /** @var string $frontendFinishUrl */
    protected $frontendFinishUrl;

    /** @var string frontendCancelUrl */
    protected $frontendCancelUrl;

    /** @var boolean $force_redirect */
    protected $force_redirect;

    /** @var string $organization_name */
    protected $organization_name;

    /** @var string $street_type */
    protected $street_type;

    /** @var string $floor */
    protected $floor;

    /** @var string $door */
    protected $door;

    /** @var string $block */
    protected $block;

    /**
     * Sets Birthdate
     *
     * @param string $birthdate
     *
     * @return $this
     */
    public function setBirthdate($birthdate)
    {
        if ($birthdate) {
            $this->birthdate = date_create($birthdate);
        }

        return $this;
    }

    /**
     * Sets force redirect value
     *
     * @param string $forceRedirect
     *
     * @return $this
     */
    public function setForceRedirect($forceRedirect)
    {
        $this->force_redirect = $forceRedirect;

        return $this;
    }

    /**
     * Gets Organization name value
     *
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->organization_name;
    }

    /**
     * Sets Organization name value
     *
     * @param string $organizationName
     *
     * @return $this
     */
    public function setOrganizationName($organizationName)
    {
        $this->organization_name = $organizationName;

        return $this;
    }

    /**
     * Gets Street Type value
     *
     * @return string
     */
    public function getStreetType()
    {
        return $this->street_type;
    }

    /**
     * Sets Street Type value
     *
     * @param string $streetType
     *
     * @return $this
     */
    public function setStreetType($streetType)
    {
        $this->street_type = $streetType;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray($object = null)
    {
        return $object ? get_object_vars($object) : get_object_vars($this);
    }
}
