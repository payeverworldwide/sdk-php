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

namespace Payever\ExternalIntegration\Payments\Notification\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity;

/**
 * This class represents Notification Result Entity
 *
 * @method float                getRefundAmount()
 * @method float                getCaptureAmount()
 * @method array                getRefundedItems()
 * @method array                getCapturedItems()
 * @method self                 setRefundAmount()
 * @method self                 setCaptureAmount()
 * @method self                 setRefundedItems()
 * @method self                 setCapturedItems()
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class NotificationResultEntity extends RetrievePaymentResultEntity
{
    /**
     * Returns the total (partial) refunded amount for this transaction
     * @var float
     */
    protected $refundAmount;

    /**
     * Returns the total (partial) captured amount for this transaction
     * @var float
     */
    protected $captureAmount;

    /**
     * Refunded items (only when cart was provided)
     * @var array
     */
    protected $refundedItems;

    /**
     * Captured items (only when cart was provided)
     * @var array
     */
    protected $capturedItems;
}
