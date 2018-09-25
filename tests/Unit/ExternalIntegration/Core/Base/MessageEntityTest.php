<?php

namespace Payever\Tests\Unit\Core\Base;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class MessageEntityTest
 *
 * @covers \Payever\ExternalIntegration\Core\Base\MessageEntity
 *
 * @package Payever\ExternalIntegration\Core\Base
 */
class MessageEntityTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $entity;

    public function setUp()
    {
        parent::setUp();

        $this->entity = $this->getMockForAbstractClass('Payever\ExternalIntegration\Core\Base\MessageEntity');
    }

    /**
     * @param array $data
     *
     * @covers \Payever\ExternalIntegration\Core\Base\MessageEntity::load()
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
     * @covers \Payever\ExternalIntegration\Core\Base\MessageEntity::isValid()
     */
    public function testIsValid()
    {
        $this->assertEmpty($this->entity->getRequired());
        $this->assertTrue($this->entity->isValid());
    }
}
