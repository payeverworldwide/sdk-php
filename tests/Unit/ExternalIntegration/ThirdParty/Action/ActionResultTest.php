<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\ThirdParty\Action\ActionResult;
use Payever\Tests\Bootstrap\TestCase;

class ActionResultTest extends TestCase
{
    /** @var ActionResult */
    private $actionResult;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->actionResult = new ActionResult();
    }

    public function testInitialState()
    {
        $this->assertEquals(0, $this->actionResult->getCreatedCount());
        $this->assertEquals(0, $this->actionResult->getUpdatedCount());
        $this->assertEquals(0, $this->actionResult->getDeletedCount());
        $this->assertEquals(0, $this->actionResult->getSkippedCount());
        $this->assertEquals(0, $this->actionResult->getErrorsCount());
        $this->assertEquals(array(), $this->actionResult->getErrors());
    }

    public function testIncrement()
    {
        $this->actionResult->incrementCreated();
        $this->assertEquals(1, $this->actionResult->getCreatedCount());

        $this->actionResult->incrementUpdated();
        $this->assertEquals(1, $this->actionResult->getUpdatedCount());

        $this->actionResult->incrementDeleted();
        $this->assertEquals(1, $this->actionResult->getDeletedCount());

        $this->actionResult->incrementSkipped();
        $this->assertEquals(1, $this->actionResult->getSkippedCount());
    }

    public function testError()
    {
        $this->assertFalse($this->actionResult->hasErrors());
        $this->assertEquals(0, $this->actionResult->getErrorsCount());
        $this->actionResult->addError('error1');
        $this->assertTrue($this->actionResult->hasErrors());
        $this->assertEquals(1, $this->actionResult->getErrorsCount());
        $this->assertEquals(array('error1'), $this->actionResult->getErrors());

        $this->actionResult->addError('error2');
        $this->assertEquals(array('error1', 'error2'), $this->actionResult->getErrors());
    }

    public function testAddException()
    {
        $this->assertFalse($this->actionResult->hasErrors());
        $this->assertEquals(0, $this->actionResult->getErrorsCount());

        $this->actionResult->addException(new \RuntimeException('critical error'));

        $this->assertTrue($this->actionResult->hasErrors());
        $this->assertEquals(1, $this->actionResult->getErrorsCount());
        $this->assertEquals(array('critical error'), $this->actionResult->getErrors());
    }
}
