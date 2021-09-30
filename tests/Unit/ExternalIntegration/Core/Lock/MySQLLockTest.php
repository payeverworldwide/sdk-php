<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Lock;

use Payever\ExternalIntegration\Core\Lock\MySQLLock;
use Payever\Tests\Bootstrap\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class MySQLLockTest extends TestCase
{
    const LOCK_NAME = 'stub_lock';

    const DATABASE_NAME = 'stub_database';

    /** @var \PDO|MockObject */
    private $pdo;

    /** @var MySQLLock */
    private $mysqlLock;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        $this->pdo = $this->createMock(\PDO::class);

        $this->mysqlLock = new MySQLLock($this->pdo);

        /** @var \PDOStatement|MockObject $statement */
        $statement = $this->createMock(\PDOStatement::class);
        $statement->expects($this->once())
            ->method('fetchColumn')
            ->willReturn(static::DATABASE_NAME);

        $this->pdo->expects($this->once())
            ->method('query')
            ->with('SELECT DATABASE()')
            ->willReturn($statement);

        $quoted = static::DATABASE_NAME . '.' . static::LOCK_NAME;
        $this->pdo->expects($this->once())
            ->method('quote')
            ->with($quoted)
            ->willReturn('escaped'  . $quoted);
    }

    public function testAcquireLock()
    {
        $timeout = 5;

        /** @var \PDOStatement|MockObject $statement */
        $statement = $this->createMock(\PDOStatement::class);
        $statement->expects($this->once())
            ->method('execute')
            ->withAnyParameters();
        $statement->expects($this->once())
            ->method('fetch')
            ->withAnyParameters()
            ->willReturn([1]);

        $this->pdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT GET_LOCK(?,?)")
            ->willReturn($statement);

        $this->mysqlLock->acquireLock(static::LOCK_NAME, $timeout);
    }

    public function testAcquireLockCaseException()
    {
        $timeout = 5;

        /** @var \PDOStatement|MockObject $statement */
        $statement = $this->createMock(\PDOStatement::class);
        $statement->expects($this->once())
            ->method('execute')
            ->withAnyParameters();
        $statement->expects($this->once())
            ->method('fetch')
            ->withAnyParameters()
            ->willReturn([0]);

        $this->pdo->expects($this->once())
            ->method('prepare')
            ->with("SELECT GET_LOCK(?,?)")
            ->willReturn($statement);
        $this->expectException(\RuntimeException::class);

        $this->mysqlLock->acquireLock(static::LOCK_NAME, $timeout);
    }

    public function testReleaseLock()
    {
        $this->pdo->expects($this->once())
            ->method('exec')
            ->withAnyParameters();

        $this->mysqlLock->releaseLock(static::LOCK_NAME);
    }
}
