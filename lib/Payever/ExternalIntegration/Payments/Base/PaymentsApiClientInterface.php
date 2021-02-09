<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Base
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Base;

use Payever\ExternalIntegration\Core\Base\CommonApiClientInterface;
use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\AuthorizePaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\SubmitPaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\ListPaymentsRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest;

/**
 * Interface represents Payever Payments API Connector
 */
interface PaymentsApiClientInterface extends CommonApiClientInterface
{
    /**
     * Sends a request to create payment
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/create-payment/create-payments Documentation
     *
     * @param CreatePaymentRequest $createPaymentRequest
     *
     * @return ResponseInterface
     */
    public function createPaymentRequest(CreatePaymentRequest $createPaymentRequest);

    /**
     * Sends a request to submit payment
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/create-payment/submit-payments Documentation
     *
     * @param SubmitPaymentRequest $createPaymentRequest
     *
     * @return ResponseInterface
     */
    public function submitPaymentRequest(SubmitPaymentRequest $createPaymentRequest);

    /**
     * Requests payment details
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/view-payments/retrieve-payment Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function retrievePaymentRequest($paymentId);

    /**
     * Requests payments details
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/view-payments/list-payments Documentation
     *
     * @param ListPaymentsRequest $listPaymentsRequest
     *
     * @return ResponseInterface
     */
    public function listPaymentsRequest(ListPaymentsRequest $listPaymentsRequest);

    /**
     * Sends a request to refund payment
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/order-management/refund Documentation
     *
     * @param string $paymentId   Payment ID
     * @param float  $amount Specify the refund amount. If no amount is set, the whole amount will be refunded.
     *
     * @return ResponseInterface
     */
    public function refundPaymentRequest($paymentId, $amount);

    /**
     * Sends a request to authorize previously made payment
     *
     * @link https://getpayever.com/developer/api-documentation/#authorize-payment Documentation
     *
     * @param string $paymentId Payment ID
     * @param AuthorizePaymentRequest $authorizePaymentRequest
     *
     * @return ResponseInterface
     */
    public function authorizePaymentRequest($paymentId, AuthorizePaymentRequest $authorizePaymentRequest);

    /**
     * Requests to remind customer to pay the bill
     *
     * @link https://getpayever.com/developer/api-documentation/#remind-payment Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function remindPaymentRequest($paymentId);

    /**
     * Requests to collect payment
     *
     * https://getpayever.com/developer/api-documentation/#collect-payments Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function collectPaymentsRequest($paymentId);

    /**
     * Requests to notify late payment
     *
     * @link https://getpayever.com/developer/api-documentation/#late-payments Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function latePaymentsRequest($paymentId);

    /**
     * Sends a request about completing shipping
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/capture-payments/shipping-goods Documentation
     *
     * @param string $paymentId  Payment ID
     * @param ShippingGoodsPaymentRequest $shippingGoodsPaymentRequest
     *
     * @return ResponseInterface
     */
    public function shippingGoodsPaymentRequest($paymentId, ShippingGoodsPaymentRequest $shippingGoodsPaymentRequest);

    /**
     * Sends a request to cancel non-completed payment
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/order-management/cancel Documentation
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function cancelPaymentRequest($paymentId);

    /**
     * Requests serialized API Call record
     *
     * @link https://getpayever.com/developer/api-documentation/#retrieve-api-call Documentation
     *
     * @param string $callId API Call ID
     *
     * @return ResponseInterface
     */
    public function retrieveApiCallRequest($callId);

    /**
     * Returns payment options
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/display-list&or&options/list-payment-options Documentation
     *
     * @param array  $params   Query part of , available params: _locale, _currency
     * @param string $businessUuid  Business UUID
     * @param string $channel       Shopsystem channel
     *
     * @return ResponseInterface
     */
    public function listPaymentOptionsRequest($params = array(), $businessUuid = '', $channel = '');

    /**
     * Same as listPaymentOptionsRequest, additionally contains list of payment option variants
     *
     * @link https://docs.payever.org/shopsystems/api/getting-started/api/display-list&or&options/list-variant-options Documentation
     *
     * @param array  $params   Query part of , available params: _locale, _currency
     * @param string $businessUuid  Business UUID
     * @param string $channel       Shopsystem channel
     *
     * @return ResponseInterface
     */
    public function listPaymentOptionsWithVariantsRequest($params = array(), $businessUuid = '', $channel = '');

    /**
     * Returns transaction
     *
     * @param string $paymentId Payment ID
     *
     * @return ResponseInterface
     */
    public function getTransactionRequest($paymentId);
}
