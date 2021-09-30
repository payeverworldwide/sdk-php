<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Notification
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Notification;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\NotificationRequestEntity;

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
