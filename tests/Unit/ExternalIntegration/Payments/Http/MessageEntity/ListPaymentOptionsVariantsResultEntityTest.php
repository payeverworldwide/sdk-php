<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsVariantsResultEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class ListPaymentOptionsVariantsResultEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'name' => 'stub_name',
        'status' => false, // will be converted to ($status == 'active')
        'variable_fee' => 1.5,
        'fixed_fee' => 10,
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
        'variants' => array(
            array(
                'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa1',
                'accept_fee' => true,
            ),
            array(
                'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa2',
                'name' => '24 months',
                'accept_fee' => false,
            ),
            array(
                'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa3',
                'name' => '32 months',
                'accept_fee' => false,
            ),
        ),
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
        return new ListPaymentOptionsVariantsResultEntity();
    }
}
