<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Logger;

use Payever\ExternalIntegration\Core\Logger\FileLogger;
use Payever\Tests\Bootstrap\TestCase;
use Psr\Log\LogLevel;

class FileLoggerTest extends TestCase
{
    /** @var resource */
    private $logFileHandle;

    /** @var string */
    private $logFilePath;

    protected function setUp()
    {
        $this->logFileHandle = tmpfile();

        $meta = stream_get_meta_data($this->logFileHandle);

        $this->logFilePath = $meta['uri'];
    }

    protected function tearDown()
    {
        flock($this->logFileHandle, LOCK_UN);
        fclose($this->logFileHandle);

        @unlink($this->logFilePath);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUnacceptableLogLevel()
    {
        new FileLogger($this->logFilePath, 'bad_level');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongBufferSize()
    {
        new FileLogger($this->logFilePath, LogLevel::DEBUG, 'stub', 0);
    }

    public function testBufferedWrite()
    {
        $logger = new FileLogger($this->logFilePath, LogLevel::DEBUG, 'stub', 2);

        $this->assertLogFileIsEmpty();

        $logger->info('test1');

        $this->assertLogFileIsEmpty();

        $logger->info('test2');

        $this->assertLogFileIsNotEmpty();
    }

    public function testLogLevelFilter()
    {
        $logger = new FileLogger($this->logFilePath, LogLevel::WARNING, 'stub', 1);

        $this->assertLogFileIsEmpty();

        $logger->debug('debug_skip');

        $this->assertLogFileIsEmpty();

        $logger->info('info_skip');

        $this->assertLogFileIsEmpty();

        $logger->warning('warning_write');

        $this->assertLogFileIsNotEmpty();
    }

    private function assertLogFileIsEmpty()
    {
        $this->assertEquals('', file_get_contents($this->logFilePath));
    }

    private function assertLogFileIsNotEmpty()
    {
        $this->assertNotEquals('', file_get_contents($this->logFilePath));
    }
}
