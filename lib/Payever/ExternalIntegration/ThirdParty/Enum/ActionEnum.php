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

class ActionEnum extends EnumerableConstants
{
    const ACTION_CREATE_PRODUCT      = 'create-product';
    const ACTION_UPDATE_PRODUCT      = 'update-product';
    const ACTION_REMOVE_PRODUCT      = 'remove-product';
    const ACTION_ADD_INVENTORY       = 'add-inventory';
    const ACTION_SET_INVENTORY       = 'set-inventory';
    const ACTION_SUBTRACT_INVENTORY  = 'subtract-inventory';
    const ACTION_PRODUCTS_SYNC       = 'products-sync';
}
