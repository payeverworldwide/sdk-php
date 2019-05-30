<?php

namespace Payever\Tests\Unit\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductCategoryEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class ProductCategoryEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'title' => 'stub_title',
        'slug' => 'stub_slug',
    );

    public function getEntity()
    {
        return new ProductCategoryEntity();
    }
}
