<?php

namespace Payever\Tests\Integration\ExternalIntegration\Payments\Action;

use Payever\ExternalIntegration\Payments\Action\ActionDecider;
use Payever\ExternalIntegration\Payments\Action\ActionDeciderInterface;
use Payever\Tests\Integration\ExternalIntegration\Payments\ApiBaseTest;

/**
 * Class ActionDeciderTest
 *
 * @see \Payever\ExternalIntegration\Payments\Action\ActionDecider
 *
 * @package Payever\ExternalIntegration\Payments
 */
class ActionDeciderTest extends ApiBaseTest
{
    /** @var ActionDecider */
    protected $actionDecider;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->actionDecider = new ActionDecider($this->paymentsApiClient);
    }

    /**
     * @param string $transactionAction
     *
     * @dataProvider transactionActionProvider
     *
     * @see       \Payever\ExternalIntegration\Payments\Action\ActionDecider::isActionAllowed()
     *
     * @throws \Exception
     */
    public function testIsActionAllowedTrue($transactionAction)
    {
        $this->getApiStubClient()->expectAction($transactionAction, true);

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $isActionAllowed = $this->actionDecider->isActionAllowed($transactionId, $transactionAction, true);

        self::assertTrue($isActionAllowed);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @param string $transactionAction
     *
     * @dataProvider transactionActionProvider
     *
     * @see       \Payever\ExternalIntegration\Payments\Action\ActionDecider::isActionAllowed()
     *
     * @throws \Exception
     */
    public function testIsActionAllowedFalse($transactionAction)
    {
        $this->getApiStubClient()->expectAction($transactionAction, false);

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $isActionAllowed = $this->actionDecider->isActionAllowed($transactionId, $transactionAction, false);

        self::assertFalse($isActionAllowed);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @param string $transactionAction
     *
     * @dataProvider transactionActionProvider
     *
     * @see \Payever\ExternalIntegration\Payments\Action\ActionDecider::isActionAllowed()
     * @throws \Exception
     */
    public function testIsActionAllowedFalseWithException($transactionAction)
    {
        $this->expectException(\Payever\ExternalIntegration\Payments\Action\ActionNotAllowedException::class);
        $this->getApiStubClient()->expectAction($transactionAction, false);

        $this->expectException('\Payever\ExternalIntegration\Payments\Action\ActionNotAllowedException');

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $this->actionDecider->isActionAllowed($transactionId, $transactionAction, true);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @param string $transactionId
     * @param string $transactionAction
     *
     * @dataProvider wrongParamsProvider
     *
     * @see \Payever\ExternalIntegration\Payments\Action\ActionDecider::isActionAllowed()
     *
     * @throws \Exception
     */
    public function testIsActionAllowedFailure($transactionId, $transactionAction)
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Wrong arguments.');

        $this->actionDecider->isActionAllowed($transactionId, $transactionAction, false);
    }

    /**
     * @throws \Exception
     */
    public function testIsCancelAllowedCaseTrue()
    {
        $this->getApiStubClient()->expectAction(ActionDeciderInterface::ACTION_CANCEL, true);

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $isActionAllowed = $this->actionDecider->isCancelAllowed($transactionId);

        self::assertTrue($isActionAllowed);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @throws \Exception
     */
    public function testIsRefundAllowedCaseTrue()
    {
        $this->getApiStubClient()->expectAction(ActionDeciderInterface::ACTION_REFUND, true);

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $isActionAllowed = $this->actionDecider->isRefundAllowed($transactionId);

        self::assertTrue($isActionAllowed);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * @throws \Exception
     */
    public function testIsShippingAllowedCaseTrue()
    {
        $this->getApiStubClient()->expectAction(ActionDeciderInterface::ACTION_SHIPPING_GOODS, true);

        $transactionId = $this->getCreatePaymentEntity()->getCall()->getId();

        $isActionAllowed = $this->actionDecider->isShippingAllowed($transactionId);

        self::assertTrue($isActionAllowed);

        $this->assertActualRequestData(array(
            'path' => '/api/rest/v1/transactions/' . $transactionId,
            'method' => 'GET',
        ));
    }

    /**
     * Provides action names
     *
     * @return array
     */
    public function transactionActionProvider()
    {
        return array(
            array(ActionDeciderInterface::ACTION_CANCEL),
            array(ActionDeciderInterface::ACTION_REFUND),
            array(ActionDeciderInterface::ACTION_RETURN),
            array(ActionDeciderInterface::ACTION_SHIPPING_GOODS),
        );
    }

    /**
     * Provides wrong params for the
     * ActionDecider::isActionAllowed() method
     *
     * @return array
     * @throws \Exception
     */
    public function wrongParamsProvider()
    {
        return array(
            'no_transactionId' => array('', 'transactionAction'),
            'no_transactionAction' => array('transactionId', ''),
        );
    }
}
