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
 * Lock for synchronous execution of critical code in concurrent environment
 */
interface LockInterface
{
    /**
     * Locking operation with $lockName until timeout reached or releaseLock called
     *
     * @param string $lockName
     * @param int $timeout - maximum seconds to wait
     *
     * @return void
     */
    public function acquireLock($lockName, $timeout);

    /**
     * Releases lock with given $name
     *
     * @param $lockName
     *
     * @return void
     */
    public function releaseLock($lockName);
}
