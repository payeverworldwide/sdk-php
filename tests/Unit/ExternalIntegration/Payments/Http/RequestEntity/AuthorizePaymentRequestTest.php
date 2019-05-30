<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Payments\Http\RequestEntity\AuthorizePaymentRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;

/**
 * Class AuthorizePaymentRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\AuthorizePaymentRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class AuthorizePaymentRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'customer_id' => 'stub_customer_id',
        'invoice_id' => 'stub_invoice_id',
        'invoice_date' => self::DEFAULT_STUB_DATE,
    );

    public function getEntity()
    {
        return new AuthorizePaymentRequest();
    }
}
