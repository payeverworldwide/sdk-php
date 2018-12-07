<?php
/**
 * Class for Payever API Main Engine
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

namespace Payever\ExternalIntegration\Core;

// @codeCoverageIgnoreStart
define('PEI_CORE_VERSION', '1.3.3');
define('PEI_CORE_MAJOR_VERSION', 1);
define('PEI_CORE_MINOR_VERSION', 3);
define('PEI_CORE_RELEASE_VERSION', 3);

define('PEI_NAMESPACE', 'Payever\ExternalIntegration');
// @codeCoverageIgnoreEnd

/**
 * Class for Payever API Main Engine
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class Engine
{
    protected static $registered = false;

    public static function getLoader()
    {
        if (!self::$registered) {
            self::$registered = spl_autoload_register(
                function ($className) {
                    if (strncmp(PEI_NAMESPACE, $className, strlen(PEI_NAMESPACE)) !== 0) {
                        return;
                    }

                    $class = substr($className, strlen(PEI_NAMESPACE));

                    $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

                    if (file_exists($filePath)) {
                        require_once $filePath;
                    }
                },
                true,
                true
            );
        }
    }
}
