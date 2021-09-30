<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Base;

use Payever\ExternalIntegration\Core\Base\NamedList;
use PHPUnit\Framework\TestCase;

/**
 * Class NamedListTest
 *
 * @see \Payever\ExternalIntegration\Core\Base\NamedList
 *
 * @package Payever\ExternalIntegration\Core\Base
 */
class NamedListTest extends TestCase
{
    /** @var NamedList */
    private $list;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->list = new NamedList();

        $this->assertEquals(0, $this->list->count());
    }

    /**
     * @return array
     */
    public function generalDataProvider()
    {
        return array(
            array(
                array(
                    'key0' => 'value',
                    'key1' => 1,
                    'key2' => array(),
                    'key3' => (object) array(),
                )
            ),
        );
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::add()
     */
    public function testAdd()
    {
        $value = 1;
        $key = 'test';

        $this->list->add($key, $value);

        $this->assertEquals(1, $this->list->count());
        $this->assertEquals($value, $this->list->get($key));
        $this->assertEquals(array($key => $value), $this->list->getAll());
    }

    /**
     * @param array $data
     *
     * @dataProvider generalDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::addAll()
     */
    public function testAddAll($data)
    {
        $this->list->addAll($data);

        $this->assertEquals($data, $this->list->getAll());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::count()
     */
    public function testCount()
    {
        $k = 0;
        $limit = 10;

        while ($limit--) {
            $this->list->add($k++, $limit);
            $this->assertEquals($k, $this->list->count());
        }
    }

    /**
     * @param array $data
     *
     * @dataProvider generalDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::contains()
     */
    public function testContains($data)
    {
        $this->assertFalse($this->list->contains('surelyNonExistentValue'));

        foreach ($data as $key => $value) {
            $this->list->add($key, $value);
            $this->assertTrue($this->list->contains($value));
        }
    }

    /**
     * @param array $data
     *
     * @dataProvider generalDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::clear()
     */
    public function testClear($data)
    {
        $this->list->addAll($data);

        $this->list->clear();

        $this->assertEquals(0, $this->list->count());
    }

    /**
     * @param array $data
     *
     * @dataProvider generalDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Base\NamedList::remove()
     */
    public function testRemove($data)
    {
        $this->list->addAll($data);

        foreach ($data as $key => $value) {
            $this->list->remove($key);
            $this->assertFalse($this->list->get($key));
        }
    }
}
