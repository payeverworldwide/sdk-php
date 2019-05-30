<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class PaymentCallEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class PaymentCallEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'payment_id' => 'stub_id',
        'customer_id' => 'stub_customer_id',
        'invoice_id' => 'stub_invoice_id',
        'invoice_date' => self::DEFAULT_STUB_DATE,
        'type' => 'create',
        'message' => 'OK',
    );

    public function getEntity()
    {
        return new PaymentCallEntity();
    }
}
