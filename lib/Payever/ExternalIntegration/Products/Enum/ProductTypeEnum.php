<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Enum
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Products\Enum;

/**
 * Represents available payever product types
 */
class ProductTypeEnum
{
    const TYPE_PHYSICAL = 'physical';
    const TYPE_DIGITAL  = 'digital';
    const TYPE_SERVICE  = 'service';
}
