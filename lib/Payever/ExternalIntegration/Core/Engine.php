<?php

/**
 * Class for Payever API Main Engine
 *
 * PHP version 5.4 and 8
 *
 * @category  API
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core;

// @codeCoverageIgnoreStart
// phpcs:disable PSR1.Files.SideEffects
define('PEI_CORE_VERSION', '4.4.0');
define('PEI_CORE_MAJOR_VERSION', 4);
define('PEI_CORE_MINOR_VERSION', 4);
define('PEI_CORE_RELEASE_VERSION', 0);

define('PEI_NAMESPACE', 'Payever\ExternalIntegration');

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new \RuntimeException('payever SDK requires PHP version 5.4 or higher.');
}
// @codeCoverageIgnoreEnd
// phpcs:enable PSR1.Files.SideEffects

/**
 * Class for Payever API Main Engine
 */
class Engine
{
    const SDK_VERSION = PEI_CORE_VERSION;

    /** @var bool */
    protected static $registered = false;

    /**
     * @retrun void
     */
    public static function registerAutoloader()
    {
        if (!self::$registered) {
            self::$registered = spl_autoload_register(
                function ($className) {
                    if (strncmp(PEI_NAMESPACE, $className, strlen(PEI_NAMESPACE)) !== 0) {
                        return;
                    }

                    $class = substr($className, strlen(PEI_NAMESPACE));

                    $filePath = sprintf(
                        '%s%s..%s.php',
                        __DIR__,
                        DIRECTORY_SEPARATOR,
                        str_replace('\\', DIRECTORY_SEPARATOR, $class)
                    );

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
