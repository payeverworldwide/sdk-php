<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Base;

use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * Class implements and describes functions of Message Entity
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
abstract class MessageEntity implements MessageEntityInterface, \ArrayAccess
{
    /**
     * Whether entity fields must be underscored when converting to array/json
     */
    const UNDERSCORE_ON_SERIALIZATION = true;

    /**
     * {@inheritdoc}
     */
    public function __construct($data = null)
    {
        if ($data) {
            $this->load($data);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        foreach ($data as $key => $value) {
            $function = StringHelper::camelize('set_' . $key);

            $this->{$function}($value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function toArray($object = null)
    {
        $result = [];

        if ($object === null) {
            $object = get_object_vars($this);
        }

        foreach ($object as $property => $value) {
            if (is_null($value)) {
                continue;
            }

            if (static::UNDERSCORE_ON_SERIALIZATION && !is_integer($property)) {
                $property = StringHelper::underscore($property);
            }

            if (is_array($value)) {
                $result[$property] = $this->toArray($value);
            } elseif ($value instanceof MessageEntity) {
                $result[$property] = $value->toArray();
            } elseif ($value instanceof \DateTime) {
                $result[$property] = $value->format(DATE_ATOM);
            } else {
                $result[$property] = $value;
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        foreach ($this->getRequired() as $property) {
            if (static::UNDERSCORE_ON_SERIALIZATION) {
                $property = StringHelper::camelize($property);
            }

            if ($this->{$property} === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Implements magic method __toString()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Set/Get attribute wrapper
     *
     * @param string $method
     * @param array  $args
     *
     * @return self|bool|mixed
     */
    public function __call($method, $args)
    {
        $property = lcfirst(substr($method, 3));

        switch (substr($method, 0, 3)) {
            case 'get':
                if (property_exists($this, $property)) {
                    return $this->{$property};
                }

                return null;
            case 'set':
                if (property_exists($this, $property)) {
                    $this->{$property} = isset($args[0]) ? $args[0] : null;
                }

                return $this;
        }

        return false;
    }

    /**
     * Implementation of \ArrayAccess::offsetSet()
     *
     * @param string $offset
     * @param mixed $value
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetset.php
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $property = StringHelper::camelize($offset);

        $this->{$property} = $value;
    }

    /**
     * Implementation of \ArrayAccess::offsetExists()
     *
     * @param string $offset
     * @return bool
     * @link http://www.php.net/manual/en/arrayaccess.offsetexists.php
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        $property = StringHelper::camelize($offset);

        return property_exists($this, $property);
    }

    /**
     * Implementation of \ArrayAccess::offsetUnset()
     *
     * @param string $offset
     * @return void
     * @link http://www.php.net/manual/en/arrayaccess.offsetunset.php
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        $property = StringHelper::camelize($offset);

        unset($this->{$property});
    }

    /**
     * Implementation of \ArrayAccess::offsetGet()
     *
     * @param string $offset
     * @return mixed
     * @link http://www.php.net/manual/en/arrayaccess.offsetget.php
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        $property = StringHelper::camelize($offset);

        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        return null;
    }
}
