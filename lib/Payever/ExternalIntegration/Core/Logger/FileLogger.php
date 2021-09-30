<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Logger
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Logger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Class FileLogger
 *
 * Simple PSR-3 compatible Logger class.
 * Recommended for use when there's no advanced logger (e.g. Monolog) provided in user's system.
 *
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class FileLogger extends AbstractLogger
{
    /** @var string */
    protected $logFilePath;

    /** @var resource  */
    protected $logFileHandle;

    /** @var string */
    protected $channelName;

    /** @var int */
    protected $logLevelInt;

    /** @var int */
    protected $bufferSize;

    /** @var array */
    protected $buffer = [];

    /** @var bool */
    protected $shutdownRegistered = false;

    /**
     * Log Levels
     * @var array
     */
    protected $logLevels = [
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT     => 1,
        LogLevel::CRITICAL  => 2,
        LogLevel::ERROR     => 3,
        LogLevel::WARNING   => 4,
        LogLevel::NOTICE    => 5,
        LogLevel::INFO      => 6,
        LogLevel::DEBUG     => 7
    ];

    /**
     * @param string $logFilePath
     * @param string $logLevel
     * @param string $channelName
     * @param int    $bufferSize
     */
    public function __construct($logFilePath, $logLevel, $channelName = 'payever', $bufferSize = 50)
    {
        if (!isset($this->logLevels[$logLevel])) {
            throw new \InvalidArgumentException(
                sprintf("Log level must be one of Psr\Log\LogLevel constants, %s given", $logLevel)
            );
        }

        if (!is_readable(dirname($logFilePath))) {
            // @codeCoverageIgnoreStart
            throw new \UnexpectedValueException(
                sprintf("The directory of log file is not readable: %s", $logFilePath)
            );
            // @codeCoverageIgnoreEnd
        }

        $bufferSize = (int) $bufferSize;

        if ($bufferSize < 1) {
            throw new \InvalidArgumentException(sprintf('Buffer size must be > 0, %d given', $bufferSize));
        }

        if (!file_exists($logFilePath)) {
            // @codeCoverageIgnoreStart
            touch($logFilePath);
            // @codeCoverageIgnoreEnd
        }
        $this->logFileHandle = fopen($logFilePath, 'a');
        if (!$this->logFileHandle) {
            // @codeCoverageIgnoreStart
            throw new \UnexpectedValueException(
                sprintf("Can't open file for writing: %s", $logFilePath)
            );
            // @codeCoverageIgnoreEnd
        }

        $this->logFilePath = $logFilePath;
        $this->logLevelInt = $this->logLevels[$logLevel];
        $this->channelName = $channelName;
        $this->bufferSize = $bufferSize;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = [])
    {
        if ($this->logLevels[$level] > $this->logLevelInt) {
            return;
        }

        if (!$this->shutdownRegistered) {
            $this->shutdownRegistered = true;
            /** __destruct doesn't get called on fatal errors */
            register_shutdown_function([$this, 'close']);
        }

        $this->buffer[] = $this->formatMessage($level, $message, $context);

        if (count($this->buffer) === $this->bufferSize) {
            $this->flush();
        }
    }

    /**
     * register_shutdown_function handler
     */
    public function close()
    {
        $this->flush();

        is_resource($this->logFileHandle) && fclose($this->logFileHandle);
    }

    /**
     * Actually writes collected messages into file
     */
    protected function flush()
    {
        foreach ($this->buffer as $message) {
            fwrite($this->logFileHandle, $message);
        }

        $this->buffer = [];
    }

    /**
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    protected function formatMessage($level, $message, array $context)
    {
        $level = strtoupper($level);

        return sprintf(
            '[%s] %s.%s: %s %s%s',
            $this->getTimestamp(),
            $this->channelName,
            $level,
            $message,
            $this->serializeContext($context),
            PHP_EOL
        );
    }

    /**
     * @param array $context
     *
     * @return string
     */
    protected function serializeContext(array $context)
    {
        return json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return string
     */
    protected function getTimestamp()
    {
        return date('Y-m-d H:i:s');
    }
}
