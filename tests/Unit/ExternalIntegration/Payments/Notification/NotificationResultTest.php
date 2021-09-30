<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Notification;

use Payever\ExternalIntegration\Payments\Notification\NotificationResult;
use Payever\Tests\Bootstrap\TestCase;

class NotificationResultTest extends TestCase
{
    /** @var NotificationResult */
    private $result;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->result = new NotificationResult();
    }

    public function testIsFailedOnException()
    {
        $this->assertFalse($this->result->isFailed());

        $exception = new \RuntimeException("MESSAGE", 1);

        $this->result->addException($exception);

        $this->assertTrue($this->result->isFailed());
    }

    public function testIsFailedOnError()
    {
        $this->assertFalse($this->result->isFailed());

        $this->result->addError('MESSAGE');

        $this->assertTrue($this->result->isFailed());
    }

    public function testOrderInfo()
    {
        $orderId = 'STUB_ORDER';
        $prevStatus = 'NEW';
        $curStatus = 'CLOSED';
        $message = 'info_message';

        $this->result->orderHasBeenCreated();
        $this->result->setOrderId($orderId);
        $this->result->setCurrentOrderStatus($curStatus);
        $this->result->setPreviousOrderStatus($prevStatus);
        $this->result->addMessage($message);

        $resultString = (string) $this->result;

        $this->assertStringContainsString('orderCreated', $resultString);
        $this->assertStringContainsString($orderId, $resultString);
        $this->assertStringContainsString($curStatus, $resultString);
        $this->assertStringContainsString($prevStatus, $resultString);
        $this->assertStringContainsString($message, $resultString);
    }
}
