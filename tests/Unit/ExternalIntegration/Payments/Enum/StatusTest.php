<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Enum;

use Payever\ExternalIntegration\Payments\Enum\Status;
use Payever\Tests\Bootstrap\TestCase;

/**
 * Class StatusTest
 *
 * @see \Payever\ExternalIntegration\Payments\Enum\Status
 *
 * @package Unit\Payever\ExternalIntegration\Payments
 */
class StatusTest extends TestCase
{
    /**
     * @see \Payever\ExternalIntegration\Payments\Enum\Status::getList()
     */
    public function testGetList()
    {
        $this->assertEquals(
            $this->collectConstants('Payever\ExternalIntegration\Payments\Enum\Status'),
            Status::enum()
        );
    }
}
