<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core\Lock;

/**
 * Lock for synchronous execution of critical code in concurrent environment
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
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
