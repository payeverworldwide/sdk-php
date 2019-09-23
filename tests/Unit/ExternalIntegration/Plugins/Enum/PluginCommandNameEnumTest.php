<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Enum;

use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\Tests\Bootstrap\TestCase;

class PluginCommandNameEnumTest extends TestCase
{
    public function testCommandNames()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum'),
            PluginCommandNameEnum::enum()
        );
    }
}
