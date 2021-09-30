<?php

namespace Payever\Tests\Bootstrap;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

/**
 * Class StubServerListener
 *
 * Manages stub server for tests
 *
 * @package Payever\ExternalIntegration\Tests
 */
class StubServerListener implements TestListener
{
    use TestListenerDefaultImplementation;

    /** @var string */
    protected $stubStartCmd = "/bin/bash vendor/bin/stub-server %s:%s";

    /** @var string */
    protected $stubServerPid;

    /** @var string */
    protected $stubWorkerPid;

    /**
     * @inheritDoc
     */
    public function startTestSuite(TestSuite $suite): void
    {
        if (!$this->isStarted()) {
            $this->start();
        }
    }

    private function isStarted()
    {
        return (bool) $this->stubServerPid && (bool) $this->stubWorkerPid;
    }

    private function start()
    {
        if (!defined('STUB_SERVER_HOST') || !defined('STUB_SERVER_PORT')) {
            exit("FATAL: You must define STUB_SERVER_HOST and STUB_SERVER_PORT constants in phpunit.xml" . PHP_EOL);
        }

        $this->stubServerPid = exec(sprintf($this->stubStartCmd, STUB_SERVER_HOST, STUB_SERVER_PORT));

        $workerPort = intval(STUB_SERVER_PORT) + 1;
        $this->stubWorkerPid = exec(sprintf($this->stubStartCmd, STUB_SERVER_HOST, $workerPort));

        // give the stub server time to boot up
        sleep(3);
    }

    private function stop()
    {
        if ($this->stubServerPid) {
            exec("kill " . $this->stubServerPid);
        }

        if ($this->stubWorkerPid) {
            exec("kill " . $this->stubWorkerPid);
        }

        $this->stubServerPid = null;
        $this->stubWorkerPid = null;
    }

    public function __destruct()
    {
        $this->stop();
    }
}
