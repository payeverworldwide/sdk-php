<?php

namespace Payever\Tests\Unit\Core\Base;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageEntityTest
 *
 * @see \Payever\ExternalIntegration\Core\Base\MessageEntity
 *
 * @package Payever\ExternalIntegration\Core\Base
 */
class MessageEntityTest extends TestCase
{
    /**
     * @var MessageEntity
     */
    private $entity;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->entity = $this->getMockForAbstractClass('Payever\ExternalIntegration\Core\Base\MessageEntity');
    }

    /**
     * @param array $data
     *
     * @see \Payever\ExternalIntegration\Core\Base\MessageEntity::load()
     *
     * @dataProvider loadDataProvider
     */
    public function testLoad($data)
    {
        $this->assertEquals(array(), $this->entity->toArray());

        $this->entity->load($data);

        /** Abstract class has no fields, so it should be always empty */
        $this->assertEquals(array(), $this->entity->toArray());
    }

    public function testSerialization()
    {
        $this->assertEquals('[]', (string) $this->entity);

        $this->entity->offsetSet('stub', 'value');

        $this->assertEquals('{"stub":"value"}', (string) $this->entity);
    }

    public function testGettingNotExistingProperty()
    {
        $this->assertNull($this->entity->offsetGet('nonexistent'));
    }

    public function testIsset()
    {
        $this->assertFalse($this->entity->offsetExists('stub'));

        $this->entity->offsetSet('stub', true);

        $this->assertTrue($this->entity->offsetExists('stub'));
    }

    public function testUnset()
    {
        $key = 'stub';
        $value = 'stub_value';

        $this->assertNull($this->entity->offsetGet($key));

        $this->entity->offsetSet($key, $value);

        $this->assertEquals($value, $this->entity->offsetGet($key));

        $this->entity->offsetUnset($key);

        $this->assertFalse($this->entity->offsetExists($key));
        $this->assertNull($this->entity->offsetGet($key));
    }

    /**
     * @return array
     */
    public function loadDataProvider()
    {
        return array(
            array(
                array(
                    'date_property' => new \DateTime(),
                    'array_property' => array('one', 'two'),
                ),
            ),
        );
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Base\MessageEntity::isValid()
     */
    public function testIsValid()
    {
        $this->assertEmpty($this->entity->getRequired());
        $this->assertTrue($this->entity->isValid());
    }
}
