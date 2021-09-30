<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Enum
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

class DirectionEnum extends EnumerableConstants
{
    const INWARD = 'inward';
    const OUTWARD = 'outward';
}
