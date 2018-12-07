<?php
/**
 * Class for Payever API Payments Engine
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments;

define('PEI_PAPI_VERSION', '1.3.3');
define('PEI_PAPI_MAJOR_VERSION', 1);
define('PEI_PAPI_MINOR_VERSION', 3);
define('PEI_PAPI_RELEASE_VERSION', 3);

use Payever\ExternalIntegration\Core\Engine as CoreEngine;

/**
 * Class for Payever API Payments Engine
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class Engine extends CoreEngine
{
}
