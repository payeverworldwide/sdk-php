<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\CreatePaymentCallEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class CreatePaymentCallEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\CreatePaymentCallEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class CreatePaymentCallEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'channel' => 'shopware',
        'amount' => 100,
        'fee' => 10,
        'order_id' => 'stub_order_id',
        'currency' => 'EUR',
        'cart' => array(),
        'salutation' => 'MR',
        'first_name' => 'stub_name',
        'last_name' => 'stub_lastname',
        'street' => 'stub_street',
        'zip' => '10111',
        'city' => 'Berlin',
        'country' => 'DE',
        'phone' => '451231212',
        'email' => 'stub@domain.com',
        'success_url' => 'https://domain.com/success',
        'failure_url' => 'https://domain.com/fail',
        'cancel_url' => 'https://domain.com/cancel',
        'notice_url' => 'https://domain.com/notice',
        'pending_url' => 'https://domain.com/pending',
        'x_frame_host' => 'domain.com',
        'payments' => array(),
        'type' => 'stub_type',
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['cart'] = array(CartItemEntityTest::getScheme());

        return $scheme;
    }

    public function getEntity()
    {
        return new CreatePaymentCallEntity();
    }
}
