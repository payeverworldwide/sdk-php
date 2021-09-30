<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Enum
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

/**
 * This class represents Statuses
 */
class Status extends EnumerableConstants
{
    const STATUS_NEW        = 'STATUS_NEW';
    const STATUS_IN_PROCESS = 'STATUS_IN_PROCESS';
    const STATUS_ACCEPTED   = 'STATUS_ACCEPTED';
    const STATUS_PAID       = 'STATUS_PAID';
    const STATUS_DECLINED   = 'STATUS_DECLINED';
    const STATUS_REFUNDED   = 'STATUS_REFUNDED';
    const STATUS_FAILED     = 'STATUS_FAILED';
    const STATUS_CANCELLED  = 'STATUS_CANCELLED';
}
