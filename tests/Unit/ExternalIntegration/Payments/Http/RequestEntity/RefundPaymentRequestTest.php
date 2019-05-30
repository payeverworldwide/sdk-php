<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\RefundPaymentRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;

/**
 * Class RefundPaymentRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\RefundPaymentRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class RefundPaymentRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'amount' => 100,
    );

    public function getEntity()
    {
        return new RefundPaymentRequest();
    }
}
