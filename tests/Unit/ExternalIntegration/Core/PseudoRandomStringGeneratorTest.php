<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\PseudoRandomStringGenerator;
use PHPUnit\Framework\TestCase;

class PseudoRandomStringGeneratorTest extends TestCase
{
    /** @var PseudoRandomStringGenerator */
    protected $generator;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new PseudoRandomStringGenerator();
    }

    public function testGenerate()
    {
        $this->assertNotEmpty($this->generator->generate());
    }
}
