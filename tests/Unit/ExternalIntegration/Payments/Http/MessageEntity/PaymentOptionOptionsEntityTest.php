<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionOptionsEntity;

/**
 * Class PaymentOptionOptionsEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionOptionsEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class PaymentOptionOptionsEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'currencies' => array('EUR', 'USD'),
        'countries' => array('DE', 'US'),
        'actions' => array('purchase'),
    );

    public function getEntity()
    {
        return new PaymentOptionOptionsEntity();
    }
}
