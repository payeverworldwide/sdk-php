<?php
/**
 * PHP version 5.4 and 7
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    Hennadii Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity;

/**
 * Class NotificationRequestEntity
 *
 * @package Payever\ExternalIntegration\Payments\Http\RequestEntity
 *
 * @method string getNotificationType()
 * @method array getNotificationTypesAvailable()
 * @method setNotificationType(string $notificationType)
 * @method setNotificationTypesAvailable(array $notificationTypes)
 * @method \DateTime|false getCreatedAt()
 * @method RetrievePaymentResultEntity getPayment()
 */
class NotificationRequestEntity extends RequestEntity
{
    /** @var string */
    protected $notificationType;

    /** @var array */
    protected $notificationTypesAvailable;

    /** @var \DateTime|bool */
    protected $createdAt;

    /** @var RetrievePaymentResultEntity */
    protected $payment;

    /**
     * @param string $createdAt
     * @return static
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $types = $this->getNotificationTypesAvailable();

        return is_array($types)
            && in_array($this->getNotificationType(), $types)
        ;
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function setData(array $data)
    {
        $this->payment = new RetrievePaymentResultEntity($data['payment']);

        return $this;
    }
}
