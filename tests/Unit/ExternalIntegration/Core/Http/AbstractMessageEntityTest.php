<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use PHPUnit\Framework\TestCase;

abstract class AbstractMessageEntityTest extends TestCase
{
    const DEFAULT_STUB_DATE = '2018-08-13T16:46:45+02:00';

    /** @var array */
    protected static $scheme = array();

    /**
     * @return MessageEntity
     */
    abstract public function getEntity();

    /**
     * @return MessageEntity
     */
    public function testEntity()
    {
        $entity = $this->getEntity();

        $this->assertEntityScheme($entity);

        $this->assertEntityValid($entity);

        return $entity;
    }

    /**
     * @return array
     */
    public static function getScheme()
    {
        return static::$scheme;
    }

    /**
     * @param MessageEntity $entity
     *
     * @param bool $autoload
     */
    protected function assertEntityScheme(MessageEntity $entity, $autoload = true)
    {
        $scheme = static::getScheme();

        if ($autoload) {
            $entity->load($scheme);
        }

        $this->compareFields($entity, $scheme);
    }

    protected function assertEntityValid(MessageEntity $entity)
    {
        $this->assertTrue($entity->isValid());
    }

    /**
     * @param MessageEntity $entity
     *
     * @param array $fields
     */
    protected function compareFields(MessageEntity $entity, array $fields)
    {
        foreach ($fields as $key => $expectedValue) {
            $realValue = $entity->offsetGet($key);

            if ($realValue instanceof MessageEntity) {
                $this->compareFields($realValue, $expectedValue);
                continue;
            }

            if ($realValue instanceof \DateTime && is_string($expectedValue)) {
                $realValue = $realValue->format(DATE_ATOM);
            }

            if (is_array($realValue)) {
                foreach ($realValue as $itemKey => $item) {
                    if ($item instanceof MessageEntity) {
                        $this->compareFields($item, $expectedValue[$itemKey]);
                    } else {
                        $this->assertEquals($expectedValue[$itemKey], $item, $key . '.' . $itemKey);
                    }
                }
                continue;
            }

            if (is_float($expectedValue) && is_float($expectedValue)) {
                $expectedValue = round($expectedValue, 2);
                $realValue = round($realValue, 2);
            }

            $this->assertEquals($expectedValue, $realValue, $key);
        }
    }
}
