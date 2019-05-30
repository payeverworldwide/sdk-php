<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class ListPaymentsResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ListPaymentsResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'status' => 'active',
        'color_state' => 'yellow',
        'merchant_name' => 'stub_merchant',
        'customer_name' => 'stub_customer',
        'payment_type' => 'sofort',
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'channel' => 'jtl',
        'reference' => 'stub_reference',
        'amount' => 200,
        'fee' => 20.5,
        'total' =>  220.5,
        'address' => array(),
        'payment_details' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['address'] = AddressEntityTest::getScheme();
        $scheme['payment_details'] = PaymentDetailsEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new ListPaymentsResultEntity();
    }
}
