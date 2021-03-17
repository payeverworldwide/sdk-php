<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Base;

/**
 * Class represents Named List
 */
class NamedList
{
    /** @var array $list */
    protected $list = [];

    /**
     * Adds an item to the list
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function add($name, $value = null)
    {
        $this->list[$name] = $value;

        return $this;
    }

    /**
     * Adds items to the list
     *
     * @param array $array
     *
     * @return $this
     */
    public function addAll(array $array)
    {
        $this->list = array_merge($this->list, $array);

        return $this;
    }

    /**
     * Clears the list
     *
     * @return $this
     */
    public function clear()
    {
        $this->list = [];

        return $this;
    }

    /**
     * Removes an item from the list
     *
     * @param string $name
     *
     * @return $this
     */
    public function remove($name)
    {
        unset($this->list[$name]);

        return $this;
    }

    /**
     * Returns list size
     *
     * @return int
     */
    public function count()
    {
        return count($this->list);
    }

    /**
     * Returns an item with the name from the list
     *
     * @param string $name
     *
     * @return array|bool|object
     */
    public function get($name)
    {
        if (isset($this->list[$name])) {
            return $this->list[$name];
        }

        return false;
    }

    /**
     * Returns the list
     *
     * @return array
     */
    public function getAll()
    {
        return $this->list;
    }

    /**
     * Checks if the item exists
     *
     * @param object $value
     *
     * @return bool
     */
    public function contains($value)
    {
        if (in_array($value, array_values($this->list), true)) {
            return true;
        }

        return false;
    }
}
