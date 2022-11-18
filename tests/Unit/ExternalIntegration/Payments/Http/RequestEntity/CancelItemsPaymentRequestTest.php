<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\PaymentItemEntity;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CancelItemsPaymentRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;

/**
 * Class CancelItemsPaymentRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\CancelItemsPaymentRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class CancelItemsPaymentRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'deliveryFee' => 100.1,
        'paymentItems' => [
            [
                'name' => 'Item 1',
                'identifier' => 'product1',
                'price' => 123.1,
                'quantity' => 1,
            ],
        ],
    );

    public function getEntity()
    {
        return new CancelItemsPaymentRequest();
    }
}
