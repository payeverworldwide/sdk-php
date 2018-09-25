<?php
/**
 * This class represents helper functions for strings
 *
 * PHP version 5.4
 *
 * @category  Helper
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Helper;

/**
 * This class represents helper functions for strings
 *
 * PHP version 5.4
 *
 * @category  Helper
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
class StringHelper
{
    /**
     * Converts field names for setters and getters
     *
     * @param string $name
     *
     * @return string
     */
    public static function underscore($name)
    {
        return strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
    }

    /**
     * Will capitalize word's first letters and convert separators if needed
     *
     * @param string $name
     * @param bool   $firstLetter
     *
     * @return string
     */
    public static function camelize($name, $firstLetter = false)
    {
        $string = str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));

        if (!$firstLetter) {
            $string = lcfirst($string);
        }

        return $string;
    }

    /**
     * Returns decoded JSON
     *
     * @param string $object
     *
     * @return bool|mixed
     * @throws \Exception
     */
    public static function jsonDecode($object)
    {
        if (!is_string($object)) {
            return $object;
        }

        $result = json_decode($object);
        if (function_exists('json_last_error')) {
            if (json_last_error() != JSON_ERROR_NONE) {
                throw new \Exception('JSON Decode Error: ' . json_last_error(), json_last_error());
            }
        }

        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
}
