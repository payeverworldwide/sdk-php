<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity\ListChannelSetsResponse;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\CallEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\MessageEntity\ListChannelSetsResultEntityTest;

/**
 * Class ListChannelSetsResponseTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\ResponseEntity\ListChannelSetsResponse
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Core\Http\ResponseEntity
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
