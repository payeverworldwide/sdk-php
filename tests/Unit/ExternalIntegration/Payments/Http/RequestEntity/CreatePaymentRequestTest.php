<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\CartItemEntityTest;

/**
 * Class CreatePaymentRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class CreatePaymentRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'channel' => 'shopware',
        'channel_set_id' => 10,
        'payment_method' => 'stripe',
        'amount' => 100,
        'fee' => 10,
        'order_id' => 'stub_order_id',
        'currency' => 'EUR',
        'cart' => array(),
        'salutation' => 'MR',
        'first_name' => 'stub_name',
        'last_name' => 'stub_lastname',
        'street' => 'stub_street',
        'street_number' => '123',
        'zip' => '10111',
        'city' => 'Berlin',
        'country' => 'DE',
        'social_security_number' => 'stub_SSN',
        'birthdate' => self::DEFAULT_STUB_DATE,
        'phone' => '451231212',
        'email' => 'stub@domain.com',
        'success_url' => 'https://domain.com/success',
        'failure_url' => 'https://domain.com/fail',
        'cancel_url' => 'https://domain.com/cancel',
        'notice_url' => 'https://domain.com/notice',
        'pending_url' => 'https://domain.com/pending',
        'x_frame_host' => 'domain.com',
        'plugin_version' => '1.0.0',
    );

    public static function getScheme()
    {
        $scheme = static::$scheme;

        $scheme['cart'] = array(CartItemEntityTest::getScheme());

        return $scheme;
    }


    public function getEntity()
    {
        return new CreatePaymentRequest();
    }

    protected function assertRequestEntityInvalid(MessageEntity $entity)
    {
        /** @var CreatePaymentRequest $innerEntity */
        $innerEntity = clone $entity;
        $innerEntity->setAmount('');
        $this->assertFalse($innerEntity->isValid());

        $innerEntity = clone $entity;
        $innerEntity->setFee('non-numeric');
        $this->assertFalse($innerEntity->isValid());

        $innerEntity = clone $entity;
        $innerEntity->setChannelSetId('non-numeric');
        $this->assertFalse($innerEntity->isValid());

        parent::assertRequestEntityInvalid($entity);
    }
}
