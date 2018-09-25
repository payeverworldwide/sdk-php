<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListChannelSetsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\CallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity\ListChannelSetsResultEntityTest;

/**
 * Class ListChannelSetsResponseTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListChannelSetsResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\ResponseEntity
 */
class ListChannelSetsResponseTest extends AbstractResponseEntityTest
{
    public static function getScheme()
    {
        return array(
            'call' => CallEntityTest::getScheme(),
            'result' => array(
                ListChannelSetsResultEntityTest::getScheme(),
            ),
        );
    }

    public function getEntity()
    {
        return new ListChannelSetsResponse();
    }
}
