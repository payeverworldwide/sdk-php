<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Action
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Action;

/**
 * This exception is thrown when a certain payment action is not allowed
 */
class ActionNotAllowedException extends \Exception
{
}
