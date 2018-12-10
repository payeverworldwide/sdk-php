<?php
/**
 * This class represents payment actions used in Payever API
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

use Payever\ExternalIntegration\Core\Base\IResponse;
use Payever\ExternalIntegration\Payments\Base\IApi;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\GetTransactionResultEntity;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetTransactionResponse;

/**
 * This class represents payment actions used in Payever API
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
class ActionDecider implements ActionDeciderInterface
{
    /** @var IApi */
    protected $api;

    /**
     * AbstractActionDecider constructor.
     *
     * @param IApi $api
     */
    public function __construct(IApi $api)
    {
        $this->api = $api;
    }

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
    public function isActionAllowed($paymentId, $transactionAction, $throwException = true)
    {
        if (empty($transactionAction) || empty($paymentId)) {
            throw new \Exception('Wrong arguments.');
        }

        /** @var IResponse $getTransactionResponse */
        $getTransactionResponse = $this->api->getTransactionRequest($paymentId);

        /** @var GetTransactionResponse $getTransactionEntity */
        $getTransactionEntity = $getTransactionResponse->getResponseEntity();

        /** @var GetTransactionResultEntity $getTransactionResult */
        $getTransactionResult = $getTransactionEntity->getResult();

        $actions = $getTransactionResult->getActions();

        foreach ($actions as $action) {
            if (is_object($action)
                && isset($action->action)
                && $action->action === $transactionAction
                && isset($action->enabled)
                && (bool) $action->enabled
            ) {
                return true;
            }
        }

        if ($throwException) {
            $message = sprintf(
                'Action "%s" is not allowed for payment id "%s"',
                $transactionAction,
                $paymentId
            );

            throw new ActionNotAllowedException($message);
        }

        return false;
    }
}
