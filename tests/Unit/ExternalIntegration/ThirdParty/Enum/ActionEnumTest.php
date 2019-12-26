<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Enum;

use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\Tests\Bootstrap\TestCase;

class ActionEnumTest extends TestCase
{
    public function testGetList()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum'),
            ActionEnum::enum()
        );
    }
}
