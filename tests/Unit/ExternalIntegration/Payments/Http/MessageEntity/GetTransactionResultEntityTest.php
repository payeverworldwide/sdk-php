<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\GetTransactionResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class GetTransactionResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\GetTransactionResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class GetTransactionResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'merchant_reference' => 'stub_reference',
        'id' => 'stub_id',
        'status' => 'success',
        'specific_status' => 'pending',
        'color_state' => 'yellow',
        'merchant_name' => 'stub_name',
        'customer_name' => 'stub_customer',
        'payment_type' => 'stripe',
        'last_action' => 'pay',
        'customer_email' => 'test@domain.com',
        'created_at' => self::DEFAULT_STUB_DATE,
        'updated_at' => self::DEFAULT_STUB_DATE,
        'channel' => 'shopware',
        'reference' => 'stub_reference',
        'amount' => 200,
        'currency' => 'EUR',
        'fee' => 0,
        'total' => 200,
        'address' => array(),
        'shipping_address' => array(),
        'payment_details_array' => array(),
        'business_shipping_option_id' => 10,
        'shipping_type' => 'DHL',
        'shipping_option_name' => 'DHL',
        'shipping_category' => 'none',
        'shipping_method_code' => null,
        'shipping_method_name' => 'DHL',
        'details_search_key' => 'stub',
        'callback_trigger' => 'stub',
        'place' => 'stub',
        'delivery_fee' => 10,
        'payment_fee' => 0,
        'down_payment' => 0,
        'payment_fee_accepted_by_merchant' => true,
        'prefilled' => false,
        'actions' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['address'] =
        $scheme['shipping_address'] = AddressEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new GetTransactionResultEntity();
    }
}
