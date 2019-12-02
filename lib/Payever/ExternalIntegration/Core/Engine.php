<?php
/**
 * Class for Payever API Main Engine
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core;

// @codeCoverageIgnoreStart
define('PEI_CORE_VERSION', '2.4.0');
define('PEI_CORE_MAJOR_VERSION', 2);
define('PEI_CORE_MINOR_VERSION', 4);
define('PEI_CORE_RELEASE_VERSION', 0);

define('PEI_NAMESPACE', 'Payever\ExternalIntegration');

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new \RuntimeException('payever SDK requires PHP version 5.4 or higher.');
}
// @codeCoverageIgnoreEnd

/**
 * Class for Payever API Main Engine
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class Engine
{
    const SDK_VERSION = PEI_CORE_VERSION;

    protected static $registered = false;

    public static function registerAutoloader()
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
