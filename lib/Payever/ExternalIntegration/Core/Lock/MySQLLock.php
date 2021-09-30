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
class MySQLLock implements LockInterface
{
    /** @var \PDO */
    private $pdo;

    /** @var string|null */
    private $currentDatabase;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @inheritdoc
     *
     * @throws \RuntimeException
     */
    public function acquireLock($lockName, $timeout)
    {
        $statement = $this->pdo->prepare("SELECT GET_LOCK(?,?)");

        $statement->execute([
            $this->prepareLockName($lockName),
            $timeout,
        ]);

        $result = $statement->fetch(\PDO::FETCH_NUM);

        if ($result[0] != 1) {
            throw new \RuntimeException(sprintf('Unable to acquire lock with name %s', $lockName));
        }
    }

    /**
     * @inheritdoc
     */
    public function releaseLock($lockName)
    {
        $statement = "SELECT RELEASE_LOCK({$this->prepareLockName($lockName)})";

        $this->pdo->exec($statement);
    }

    /**
     * @param string $lockName
     * @return string
     */
    private function prepareLockName($lockName)
    {
        return $this->pdo->quote("{$this->getCurrentDatabase()}.{$lockName}");
    }

    /**
     * @return string|null
     */
    private function getCurrentDatabase()
    {
        if (null === $this->currentDatabase) {
            $this->currentDatabase = $this->pdo->query('SELECT DATABASE()')->fetchColumn();
        }

        return $this->currentDatabase;
    }
}
