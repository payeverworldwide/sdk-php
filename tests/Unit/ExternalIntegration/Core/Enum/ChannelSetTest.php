<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Enum;

use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\Tests\Bootstrap\TestCase;

/**
 * Class ChannelSetTest
 *
 * @see \Payever\ExternalIntegration\Core\Enum\ChannelSet
 *
 * @package Payever\ExternalIntegration\Core
 */
class ChannelSetTest extends TestCase
{
    /**
     * @see \Payever\ExternalIntegration\Core\Enum\ChannelSet::getList()
     *
     * @throws \ReflectionException
     */
    public function testGetList()
    {
        $this->assertEquals($this->collectConstants('Payever\ExternalIntegration\Core\Enum\ChannelSet'), ChannelSet::enum());
    }
}
