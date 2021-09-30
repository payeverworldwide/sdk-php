<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Enum
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

/**
 * List of salutations
 */
class Salutation extends EnumerableConstants
{
    const SALUTATION_MR = 'SALUTATION_MR';
    const SALUTATION_MS = 'SALUTATION_MS';
}
