<?php
/**
 * This class represents Statuses
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments;

/**
 * This class represents Statuses
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class Status
{
    const STATUS_NEW        = 'STATUS_NEW';
    const STATUS_IN_PROCESS = 'STATUS_IN_PROCESS';
    const STATUS_ACCEPTED   = 'STATUS_ACCEPTED';
    const STATUS_PAID       = 'STATUS_PAID';
    const STATUS_DECLINED   = 'STATUS_DECLINED';
    const STATUS_REFUNDED   = 'STATUS_REFUNDED';
    const STATUS_FAILED     = 'STATUS_FAILED';
    const STATUS_CANCELLED  = 'STATUS_CANCELLED';

    /**
     * Returns Statuses available
     *
     * @return array
     */
    public static function getList()
    {
        return array(
            static::STATUS_NEW,
            static::STATUS_IN_PROCESS,
            static::STATUS_ACCEPTED,
            static::STATUS_PAID,
            static::STATUS_DECLINED,
            static::STATUS_REFUNDED,
            static::STATUS_FAILED,
            static::STATUS_CANCELLED,
        );
    }
}
