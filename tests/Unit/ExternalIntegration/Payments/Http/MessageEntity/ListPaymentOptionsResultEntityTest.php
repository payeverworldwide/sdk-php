<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class ListPaymentOptionsResultEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsResultEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ListPaymentOptionsResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'name' => 'stub_name',
        'status' => false, // will be converted to ($status == 'active')
        'variable_fee' => 1.5,
        'fixed_fee' => 10,
        'accept_fee' => false,
        'description_offer' => 'stub_offer_description',
        'description_fee' => 'stub_fee_description',
        'min' => 100,
        'max' => 10000,
        'payment_method' => 'stripe',
        'type' => 'stripe',
        'slug' => 'stripe_slug',
        'thumbnail_1' => 'some_image',
        'thumbnail_2' => null,
        'thumbnail_3' => null,
        'options' => array(),
        'translations' => array(),
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['options'] = PaymentOptionOptionsEntityTest::getScheme();
        $scheme['translations'] = array(PaymentOptionTranslationEntityTest::getScheme());

        return $scheme;
    }

    public function getEntity()
    {
        return new ListPaymentOptionsResultEntity();
    }
}
