<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Enum;

use Payever\ExternalIntegration\ThirdParty\Enum\Action;
use Payever\Tests\Bootstrap\TestCase;

class ActionTest extends TestCase
{
    public function testGetList()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\ExternalIntegration\ThirdParty\Enum\Action'),
            Action::enum()
        );
    }
}
