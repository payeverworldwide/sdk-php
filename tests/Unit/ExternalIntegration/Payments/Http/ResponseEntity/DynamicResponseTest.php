<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\DynamicResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\DynamicEntityTest;

/**
 * Class DynamicResponseTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\ResponseEntity\DynamicResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class DynamicResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return DynamicEntityTest::getScheme();
    }

    public function getEntity()
    {
        return new DynamicResponse();
    }
}
