<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity\DynamicResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\DynamicEntityTest;

/**
 * Class DynamicResponseTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\ResponseEntity\DynamicResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity
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
