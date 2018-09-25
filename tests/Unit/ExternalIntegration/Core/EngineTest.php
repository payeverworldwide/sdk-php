<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\Engine;
use PHPUnit\Framework\TestCase;

/**
 * Class EngineTest
 *
 * @covers \Payever\ExternalIntegration\Core\Engine
 *
 * @package Payever\ExternalIntegration\Core
 */
class EngineTest extends TestCase
{
    /**
     * @covers \Payever\ExternalIntegration\Core\Engine::getLoader()
     */
    public function testAutoloaderRegistered()
    {
        $loadersCount = count(spl_autoload_functions()) + 1;

        Engine::getLoader();

        $this->assertEquals($loadersCount, count(spl_autoload_functions()));

        Engine::getLoader();

        // second call should not register any loader
        $this->assertEquals($loadersCount, count(spl_autoload_functions()));
    }
}
