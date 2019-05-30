<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsCallEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class ListPaymentsCallEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentsCallEntity
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
