<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionOptionsEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class PaymentOptionOptionsEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionOptionsEntity
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
