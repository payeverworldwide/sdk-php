<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Lock;

use Payever\ExternalIntegration\Core\Lock\FileLock;
use Payever\Tests\Bootstrap\TestCase;

class FileLockTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testBadDirectory()
    {
        $this->expectException(\UnexpectedValueException::class);
        new FileLock('/wrong/dir');
    }

    public function testLockTimeOut()
    {
        $lock = new FileLock(sys_get_temp_dir());
        $lockName = 'stub';
        $timeout = 2;

        $start = time();
        $lock->acquireLock($lockName, $timeout);
        $lock->acquireLock($lockName, $timeout);
        $this->assertEquals($timeout, time() - $start);

        $lock->releaseLock($lockName);

        $start = time();
        $lock->acquireLock($lockName, $timeout);
        $lock->releaseLock($lockName);
        $lock->acquireLock($lockName, $timeout);
        $lock->releaseLock($lockName);
        $this->assertEquals(0, time() - $start);
    }
}
