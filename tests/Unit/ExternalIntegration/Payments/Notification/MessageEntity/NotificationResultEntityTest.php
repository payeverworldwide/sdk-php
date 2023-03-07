<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Notification\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\PaymentDetailsEntityTest;
use Payever\ExternalIntegration\Payments\Notification\MessageEntity\NotificationResultEntity;

/**
 * Class NotificationResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\RetrievePaymentResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class NotificationResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'status' => 'active',
        'color_state' => 'yellow',
        'merchant_name' => 'stub_merchant',
        'customer_name' => 'stub_customer',
        'payment_type' => 'sofort',
        'last_action' => 'create',
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'channel' => 'jtl',
        'reference' => 'stub_reference',
        'amount' => 200,
        'refund_amount' => 0,
        'captured_amount' => 0,
        'refunded_items' => array(),
        'captured_items' => array(),
        'fee' => 20.5,
        'total' =>  220.5,
        'address' => array(),
        'payment_details' => array(),
        'payment_details_array' => array('pan_id' => 'stub'),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['payment_details'] = PaymentDetailsEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new NotificationResultEntity();
    }
}
