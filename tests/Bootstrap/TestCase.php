<?php

namespace Payever\Tests\Bootstrap;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param mixed $obj
     * @param string $name
     * @param array $args
     *
     * @return \ReflectionMethod
     *
     * @throws \ReflectionException
     */
    protected function invokeProtectedMethod($obj, $name, $args = [])
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

    /**
     * @param mixed $obj
     * @param string $name
     * @param mixed $value
     *
     * @return void
     *
     * @throws \ReflectionException
     */
    protected function setProtectedPropertyValue($obj, $name, $value)
    {
        $reflectionClass = new \ReflectionClass($obj);
        $reflectionProperty = $reflectionClass->getProperty($name);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($obj, $value);
    }

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    protected function collectConstants($className)
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->getConstants();
    }
}
