<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Lock
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Lock;

/**
 * @SuppressWarnings(PHPMD.MissingImport)
 */
class FileLock implements LockInterface
{
    const SLEEP_SECONDS = 1;

    /** @var string */
    private $directory;

    /**
     * FileLock constructor.
     *
     * @param string $directory
     */
    public function __construct($directory)
    {
        if (!is_writable($directory)) {
            throw new \UnexpectedValueException(sprintf('Directory %s is not writable', $directory));
        }

        $this->directory = $directory;
    }

    /**
     * @inheritdoc
     */
    public function acquireLock($lockName, $timeout)
    {
        $filename = $this->getLockFileName($lockName);

        $this->waitForUnlock($filename, $timeout);

        $this->releaseLock($lockName);

        $this->lock($filename);
    }

    /**
     * @inheritdoc
     */
    public function releaseLock($lockName)
    {
        $filename = $this->getLockFileName($lockName);

        $this->unlock($filename);
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getLockFileName($name)
    {
        return $this->directory . DIRECTORY_SEPARATOR . $name . ".lock";
    }

    /**
     * @param string $filename
     */
    private function lock($filename)
    {
        $handle = fopen($filename, "w");
        $handle && fclose($handle);
    }

    /**
     * @param string $filename
     */
    private function unlock($filename)
    {
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * @param string $filename
     * @param int $timeout
     */
    private function waitForUnlock($filename, $timeout)
    {
        if (file_exists($filename)) {
            $maxTimestamp = filectime($filename) + $timeout;
            while (file_exists($filename) && time() < $maxTimestamp) {
                sleep(self::SLEEP_SECONDS);
            }
        }
    }
}
