<?php
/**
 * This class represents Cart Item Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Cart Item Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method \DateTime|false  getBirthdate()
 * @method bool             getConditionsAccepted()
 * @method string           getRiskSessionId()
 * @method string           getFrontendFinishUrl()
 * @method string           getFrontendCancelUrl()
 * @method self             setConditionsAccepted()
 * @method self             setRiskSessionId()
 * @method self             setFrontendFinishUrl()
 * @method self             setFrontendCancelUrl()
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

    /**
     * Sets Birthdate
     *
     * @param string $birthdate
     *
     * @return $this
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = date_create($birthdate);

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
