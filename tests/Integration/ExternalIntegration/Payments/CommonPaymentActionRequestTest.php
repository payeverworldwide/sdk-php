<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\Http\Response;

/**
 * Class CommonPaymentActionRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient
 *
 * @package Integration\Payever\ExternalIntegration\Payments
 */
class CommonPaymentActionRequestTest extends ApiBaseTest
{
    /**
     * @param string $action
     * @param string $apiRequestMethod
     * @param bool $isSuccess
     * @param mixed $arg2
     *
     * @dataProvider paymentActionsDatProvider
     *
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::cancelPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::shippingGoodsPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::authorizePaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::latePaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listPaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::collectPaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::remindPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::refundPaymentRequest()
     *
     * @throws \Exception
     */
    public function testPaymentAction($action, $apiRequestMethod, $isSuccess, $arg2 = null)
    {
        $this->getApiStubClient()->expectAction($action, $isSuccess);

        if (!$isSuccess) {
            $this->expectException('Exception');
        }

        if (is_null($arg2)) {
            $response = $this->paymentsApiClient->{$apiRequestMethod}(
                $this->getCreatePaymentEntity()->getCall()->getId()
            );
        } else {
            $response = $this->paymentsApiClient->{$apiRequestMethod}(
                $this->getCreatePaymentEntity()->getCall()->getId(),
                $arg2
            );
        }

        /** @var Response $response */
        self::assertTrue($response->getResponseEntity()->isValid());
    }

    /**
     * @param string $action
     * @param string $apiRequestMethod
     * @param bool $isSuccess
     * @param mixed $arg2
     *
     * @dataProvider paymentActionsDatProvider
     *
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::cancelPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::shippingGoodsPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::authorizePaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::latePaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::listPaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::collectPaymentsRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::remindPaymentRequest()
     * @see \Payever\ExternalIntegration\Payments\PaymentsApiClient::refundPaymentRequest()
     */
    public function testPaymentActionNotLoadedApi($action, $apiRequestMethod, $isSuccess, $arg2 = null)
    {
        $this->expectException(\Exception::class);
        $this->paymentsApiClient->getConfiguration()->setClientSecret(null);
        $this->paymentsApiClient->getConfiguration()->setClientId(null);
        $this->paymentsApiClient->getConfiguration()->setBusinessUuid(null);

        $this->getApiStubClient()->expectAction($action, $isSuccess);

        if (is_null($arg2)) {
            $this->paymentsApiClient->{$apiRequestMethod}(
                $this->getCreatePaymentEntity()->getCall()->getId()
            );
        } else {
            $this->paymentsApiClient->{$apiRequestMethod}(
                $this->getCreatePaymentEntity()->getCall()->getId(),
                $arg2
            );
        }
    }

    /**
     * @return array
     */
    public function paymentActionsDatProvider()
    {
        return array(
            'authorize success' => array('authorize', 'authorizePaymentRequest', true),
            'authorize failure' => array('authorize', 'authorizePaymentRequest', false),

            'cancel success' => array('cancel', 'cancelPaymentRequest', true),
            'cancel failure' => array('cancel', 'cancelPaymentRequest', false),

            'collect success' => array('collect', 'collectPaymentsRequest', true),
            'collect failure' => array('collect', 'collectPaymentsRequest', false),

            'late-payment success' => array('late-payment', 'latePaymentsRequest', true),
            'late-payment failure' => array('late-payment', 'latePaymentsRequest', false),

            'refund success' => array('refund', 'refundPaymentRequest', true, array()),
            'refund failure' => array('refund', 'refundPaymentRequest', false, array()),

            'remind success' => array('remind', 'remindPaymentRequest', true),
            'remind failure' => array('remind', 'remindPaymentRequest', false),

            'shipping-goods success' => array('shipping-goods', 'shippingGoodsPaymentRequest', true),
            'shipping-goods failure' => array('shipping-goods', 'shippingGoodsPaymentRequest', false),
        );
    }
}
