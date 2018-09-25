<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Payments\Status;
use Payever\Tests\Bootstrap\TestCase;

/**
 * Class StatusTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Status
 *
 * @package Unit\Payever\ExternalIntegration\Payments
 */
class StatusTest extends TestCase
{
    /**
     * @covers \Payever\ExternalIntegration\Payments\Status::getList()
     */
    public function testGetList()
    {
        $this->assertEquals($this->collectConstants('Payever\ExternalIntegration\Payments\Status'), Status::getList());
    }
}
