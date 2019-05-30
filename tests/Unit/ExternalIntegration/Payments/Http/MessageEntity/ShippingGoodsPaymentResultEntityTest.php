<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ShippingGoodsPaymentResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\ChannelSetEntityTest;

/**
 * Class ShippingGoodsPaymentResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\ShippingGoodsPaymentResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ShippingGoodsPaymentResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'address' => array(),
        'amount' => 200,
        'channel' => 'jtl',
        'channel_set' => array(),
        'color_state' => 'yellow',
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'currency' => 'EUR',
        'customer_name' => 'stub_customer',
        'fee' => 20.5,
        'id' => 'stub_id',
        'items' => array(),
        'last_action' => 'shipping_goods',
        'merchant_name' => 'stub_merchant',
        'other_fees' => 0.0,
        'payever_commission' => 2,
        'payment_type' => 'sofort',
        'reference' => 'stub_reference',
        'total' =>  220.5,
        'payment_details' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['address'] = AddressEntityTest::getScheme();
        $scheme['channel_set'] = ChannelSetEntityTest::getScheme();
        $scheme['payment_details'] = PaymentDetailsEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new ShippingGoodsPaymentResultEntity();
    }
}
