<?php
/**
 * This interface represents payment actions used in Payever API
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Payments\Action;

/**
 * Interface ActionDeciderInterface
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
interface ActionDeciderInterface
{
    const ACTION_AUTHORIZE = 'authorize';
    const ACTION_CANCEL = 'cancel';
    const ACTION_CHANGE_AMOUNT = 'change_amount';
    const ACTION_COLLECTION = 'collection';
    const ACTION_LATE_PAYMENT = 'late_payment';
    const ACTION_PAID = 'paid';
    const ACTION_REMIND = 'remind';
    const ACTION_RETURN = 'return';
    const ACTION_SHIPPING_GOODS = 'shipping_goods';
    const ACTION_UPLOAD = 'upload';
    const ACTION_EDIT = 'edit';

    /**
     * Check if the action for the transaction is allowed
     *
     * @param string $paymentId
     * @param string $transactionAction
     * @param bool $throwException
     *
     * @return bool
     * @throws \Exception
     */
    public function isActionAllowed($paymentId, $transactionAction, $throwException = true);
}