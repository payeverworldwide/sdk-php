<?php

namespace Payever\Tests\Bootstrap\Inventory\Base;

use Payever\ExternalIntegration\Inventory\Base\InventoryIteratorInterface;

class InventoryIterator implements InventoryIteratorInterface
{
    /** @var array */
    protected $inventoryItems;

    /**
     * @param array $inventoryItems
     */
    public function __construct(array $inventoryItems)
    {
        $this->inventoryItems = $inventoryItems;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        next($this->inventoryItems);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->inventoryItems);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        reset($this->inventoryItems);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->inventoryItems);
    }
}
