<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
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
