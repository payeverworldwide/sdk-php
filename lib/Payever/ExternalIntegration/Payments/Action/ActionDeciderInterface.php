<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Action
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Action;

/**
 * Interface ActionDeciderInterface
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
    /** @deprecated will be removed in future versions, refund should be used instead */
    const ACTION_RETURN = 'return';
    const ACTION_REFUND = 'refund';
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
     * @throws \Exception when $throwException is true and target action is not allowed
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function isActionAllowed($paymentId, $transactionAction, $throwException = true);

    /**
     * Check if the partial action for the transaction is allowed
     *
     * @param string $paymentId
     * @param string $transactionAction
     * @param bool $throwException
     *
     * @return bool
     * @throws \Exception when $throwException is true and target action is not allowed
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function isPartialActionAllowed(
        $paymentId,
        $transactionAction,
        $throwException = true
    );
}
