<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsCallEntity;

/**
 * Class ListPaymentsCallEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsCallEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class ListPaymentsCallEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'currency' => 'EUR',
        'state' => 'active',
        'limit' => 100,
    );

    public function getEntity()
    {
        return new ListPaymentsCallEntity();
    }
}
