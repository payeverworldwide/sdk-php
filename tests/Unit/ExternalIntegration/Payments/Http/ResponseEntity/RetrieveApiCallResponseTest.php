<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\RetrieveApiCallResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\DynamicEntityTest;

/**
 * Class RetrieveApiCallResponseTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\ResponseEntity\RetrieveApiCallResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class RetrieveApiCallResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => DynamicEntityTest::getScheme(),
        );
    }

    public function getEntity()
    {
        return new RetrieveApiCallResponse();
    }
}
