<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Notification;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\NotificationRequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface NotificationHandlerInterface
{
    /**
     * Must process notification and fill given NotificationResult instance.
     * Must handle all exceptions internally and put exception messages inside result object.
     *
     * @param NotificationRequestEntity $notification
     * @param NotificationResult $notificationResult
     *
     * @return void
     */
    public function handleNotification(
        NotificationRequestEntity $notification,
        NotificationResult $notificationResult
    );
}
