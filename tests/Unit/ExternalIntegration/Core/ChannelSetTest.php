<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\Tests\Bootstrap\TestCase;

/**
 * Class ChannelSetTest
 *
 * @covers \Payever\ExternalIntegration\Core\ChannelSet
 *
 * @package Payever\ExternalIntegration\Core
 */
class ChannelSetTest extends TestCase
{
    /**
     * @covers \Payever\ExternalIntegration\Core\ChannelSet::getList()
     *
     * @throws \ReflectionException
     */
    public function testGetList()
    {
        $this->assertEquals($this->collectConstants('Payever\ExternalIntegration\Core\ChannelSet'), ChannelSet::getList());
    }
}
