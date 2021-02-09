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

    public function testConstantNameByValue()
    {
        $this->assertNotEmpty(ChannelSet::constantNameByValue('other_shopsystem'));
    }

    public function testConstantNameByValueCaseNotFound()
    {
        $this->assertEmpty(ChannelSet::constantNameByValue('unknown-value'));
    }

    public function testValueOf()
    {
        $this->assertNotEmpty(ChannelSet::valueOf('CHANNEL_OTHER_SHOPSYSTEM'));
    }
}
