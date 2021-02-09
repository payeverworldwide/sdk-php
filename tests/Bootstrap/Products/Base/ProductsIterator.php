<?php

namespace Payever\Tests\Bootstrap\Products\Base;

use Payever\ExternalIntegration\Products\Base\ProductsIteratorInterface;

class ProductsIterator implements ProductsIteratorInterface
{
    /** @var array */
    protected $products;

    /**
     * @param array $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        next($this->products);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->products);
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
        reset($this->products);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->products);
    }
}
