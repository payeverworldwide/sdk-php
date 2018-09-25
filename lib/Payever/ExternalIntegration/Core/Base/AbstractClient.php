<?php
/**
 * Class describes functions of Client
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Base;

/**
 * Class describes functions of Client
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
abstract class AbstractClient
{
    /**
     * Executes request
     *
     * @param IRequest $request
     *
     * @return IResponse
     */
    abstract public function execute($request);
}
