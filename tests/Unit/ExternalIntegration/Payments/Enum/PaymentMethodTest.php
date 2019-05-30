<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Enum;

use Payever\ExternalIntegration\Payments\Enum\PaymentMethod;
use Payever\Tests\Bootstrap\TestCase;

class PaymentMethodTest extends TestCase
{
    public function testShouldHideOnDifferentAddress()
    {
        $shouldHideMethods = PaymentMethod::getShouldHideOnDifferentAddressMethods();

        foreach ($shouldHideMethods as $method) {
            $this->assertTrue(PaymentMethod::shouldHideOnDifferentAddress($method));
        }

        $shouldNotHideMethods = array_diff(PaymentMethod::enum(), $shouldHideMethods);

        foreach ($shouldNotHideMethods as $method) {
            $this->assertFalse(PaymentMethod::shouldHideOnDifferentAddress($method));
        }
    }

    public function testShouldHideOnReject()
    {
        $shouldHideMethods = PaymentMethod::getShouldHideOnRejectMethods();

        foreach ($shouldHideMethods as $method) {
            $this->assertTrue(PaymentMethod::shouldHideOnReject($method));
        }

        $shouldNotHideMethods = array_diff(PaymentMethod::enum(), $shouldHideMethods);

        foreach ($shouldNotHideMethods as $method) {
            $this->assertFalse(PaymentMethod::shouldHideOnReject($method));
        }
    }
}
