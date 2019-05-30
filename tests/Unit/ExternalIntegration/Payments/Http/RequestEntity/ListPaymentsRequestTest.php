<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Payments\Enum\Status;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\ListPaymentsRequest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractRequestEntityTest;

/**
 * Class ListPaymentsRequestTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\RequestEntity\ListPaymentsRequest
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\RequestEntity
 */
class ListPaymentsRequestTest extends AbstractRequestEntityTest
{
    protected static $scheme = array(
        'access_token' => 'stub_access_token',
        'payment_method' => 'stripe',
        'date' => self::DEFAULT_STUB_DATE,
        'currency' => 'EUR',
        'state' => Status::STATUS_NEW,
        'limit' => 10,
    );

    public function getEntity()
    {
        return new ListPaymentsRequest();
    }

    protected function assertRequestEntityInvalid(MessageEntity $entity)
    {
        /** @var ListPaymentsRequest $innerEntity */
        $innerEntity = clone $entity;
        $innerEntity->setState('wrong_nonexistent_state');
        $this->assertFalse($innerEntity->isValid());

        parent::assertRequestEntityInvalid($entity);
    }
}
