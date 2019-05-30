<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetTransactionResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\GetTransactionResultEntityTest;

/**
 * Class GetTransactionResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetTransactionResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class GetTransactionResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'result' => GetTransactionResultEntityTest::getScheme(),
        );
    }

    public function getEntity()
    {
        return new GetTransactionResponse();
    }
}
