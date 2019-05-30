<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\CartItemEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class CartItemEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\CartItemEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class CartItemEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'name' => 'stub_name',
        'price' => 100.55,
        'quantity' => 2,
        'description' => 'stub_description',
        'thumbnail' => 'stub',
        'sku' => 'stub_sku',
        'price_netto' => 90,
        'vat_rate' => 10.55,
    );

    public function getEntity()
    {
        return new CartItemEntity();
    }
}
