<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Enum;

use Payever\ExternalIntegration\ThirdParty\Enum\DirectionEnum;
use Payever\Tests\Bootstrap\TestCase;

class DirectionEnumTest extends TestCase
{
    public function testGetList()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\ExternalIntegration\ThirdParty\Enum\DirectionEnum'),
            DirectionEnum::enum()
        );
    }
}
