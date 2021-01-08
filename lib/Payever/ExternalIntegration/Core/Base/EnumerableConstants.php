<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core\Base;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
abstract class EnumerableConstants
{
    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function enum()
    {
        $ref = new \ReflectionClass(new static());
        $constants = $ref->getConstants();

        return $constants;
    }

    /**
     * @param mixed $value
     * @return mixed
     *
     * @throws \ReflectionException
     */
    public static function constantNameByValue($value)
    {
        foreach (self::enum() as $name => $val) {
            if ($val === $value) {
                return $name;
            }
        }

        return null;
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     *
     * @throws \ReflectionException
     */
    public static function valueOf($name)
    {
        $enums = self::enum();

        return array_key_exists($name, $enums) ? $enums[$name] : null;
    }
}
