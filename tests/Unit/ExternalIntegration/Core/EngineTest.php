<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\Engine;
use PHPUnit\Framework\TestCase;

/**
 * Class EngineTest
 *
 * @see \Payever\ExternalIntegration\Core\Engine
 *
 * @package Payever\ExternalIntegration\Core
 */
class EngineTest extends TestCase
{
    /**
     * @see \Payever\ExternalIntegration\Core\Engine::registerAutoloader()
     */
    public function testAutoloaderRegistered()
    {
        $loadersCount = count(spl_autoload_functions()) + 1;

        Engine::registerAutoloader();

        $this->assertEquals($loadersCount, count(spl_autoload_functions()));

        Engine::registerAutoloader();

        // second call must not register any loader
        $this->assertEquals($loadersCount, count(spl_autoload_functions()));
    }
}
