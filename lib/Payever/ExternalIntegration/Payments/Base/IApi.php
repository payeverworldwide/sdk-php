<?php
/**
 * Interface represents Payever Payments API Connector
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Payments\Base;

use Payever\ExternalIntegration\Core\Base\AbstractClient;
use Payever\ExternalIntegration\Core\Base\IResponse;
use Payever\ExternalIntegration\Core\Base\IToken;

/**
 * Interface represents Payever Payments API Connector
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
interface IApi
{
    /**
     * Returns an instance of API class
     *
     * @return $this
     */
    public static function getInstance();

    /**
     * Requests new oAuth Token which will be used further
     *
     * @param string $scope Scope in which the token will be used
     *
     * @return IResponse
     */
    public function obtainTokenRequest($scope);

    /**
     * Requests for an updated oAuth Token data
     *
     * @param IToken|object|array $token Token for the update
     *
     * @return IResponse
     */
    public function refreshTokenRequest($token);

    /**
     * Sends a request to create payment
     *
     * @link https://getpayever.com/developer/api-documentation/#create-payment Documentation
     *
     * @param array $orderData Order data
     *
     * @return IResponse
     */
    public function createPaymentRequest($orderData);

    /**
     * Requests payment details
     *
     * @link https://getpayever.com/developer/api-documentation/#retrieve-payment Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function retrievePaymentRequest($paymentId);

    /**
     * Requests payments details
     *
     * @link https://getpayever.com/developer/api-documentation/#list-payments Documentation
     *
     * @param string    $method   Retrieve only transactions for the given payment_method
     * @param \DateTime $date     Retrieve only transactions for the given date
     * @param string    $currency Retrieve only payments with the given currency
     * @param string    $status   Retrieve only payments with the given state
     * @param int       $limit    Limit the output of retrieved transactions (default = 10)
     *
     * @return IResponse
     */
    public function listPaymentsRequest($method = null, $date = null, $currency = null, $status = null, $limit = 10);

    /**
     * Sends a request to refund payment
     *
     * @link https://getpayever.com/developer/api-documentation/#refund-payment Documentation
     *
     * @param string $paymentId   Payment ID
     * @param float  $amount Specify the refund amount. If no amount is set, the whole amount will be refunded.
     *
     * @return IResponse
     */
    public function refundPaymentRequest($paymentId, $amount);

    /**
     * Sends a request to authorize previously made payment
     *
     * @link https://getpayever.com/developer/api-documentation/#authorize-payment Documentation
     *
     * @param string    $paymentId   Payment ID
     * @param array     $data
     *
     * @return IResponse
     */
    public function authorizePaymentRequest($paymentId, $data);

    /**
     * Requests to remind customer to pay the bill
     *
     * @link https://getpayever.com/developer/api-documentation/#remind-payment Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function remindPaymentRequest($paymentId);

    /**
     * Requests to collect payment
     *
     * https://getpayever.com/developer/api-documentation/#collect-payments Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function collectPaymentsRequest($paymentId);

    /**
     * Requests to notify late payment
     *
     * @link https://getpayever.com/developer/api-documentation/#late-payments Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function latePaymentsRequest($paymentId);

    /**
     * Sends a request about completing shipping
     *
     * @link https://getpayever.com/developer/api-documentation/#shipping-goods-payment Documentation
     *
     * @param string $paymentId  Payment ID
     * @param array  $data Order data
     *
     * @return IResponse
     */
    public function shippingGoodsPaymentRequest($paymentId, $data = array());

    /**
     * Sends a request to cancel non-completed payment
     *
     * @link https://getpayever.com/developer/api-documentation/#cancel-payment Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function cancelPaymentRequest($paymentId);

    /**
     * Requests serialized API Call record
     *
     * @link https://getpayever.com/developer/api-documentation/#retrieve-api-call Documentation
     *
     * @param string $callId API Call ID
     *
     * @return IResponse
     */
    public function retrieveApiCallRequest($callId);

    /**
     * Returns payment options
     *
     * @link https://getpayever.com/developer/api-documentation/#list-payment-options Documentation
     *
     * @param string $slug    Business slug
     * @param string $channel Shopsystem channel
     * @param string $lang    Language in ISO-2 format
     *
     * @return IResponse
     */
    public function listPaymentOptionsRequest($slug, $channel, $lang);

    /**
     * Returns available Channel Sets
     *
     * @link https://getpayever.com/developer/api-documentation/#list-channel-sets Documentation
     *
     * @param string $slug Business slug
     *
     * @return IResponse
     */
    public function listChannelSetsRequest($slug);

    /**
     * Returns currencies available
     *
     * @param string $lang Language in ISO-2 format
     *
     * @return IResponse
     */
    public function getCurrenciesRequest($lang);

    /**
     * Returns transaction
     *
     * @param string $paymentId Payment ID
     *
     * @return IResponse
     */
    public function getTransactionRequest($paymentId);

    /**
     * Returns client
     *
     * @return AbstractClient
     */
    public function getClient();

    /**
     * Sets client
     *
     * @param AbstractClient $client
     *
     * @return self
     */
    public function setClient($client);
}
