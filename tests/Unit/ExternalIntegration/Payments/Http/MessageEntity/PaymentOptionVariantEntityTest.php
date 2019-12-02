<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionVariantEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class PaymentOptionVariantEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'variant_id' => 'a69ae3ff-269b-44c4-83f0-2d3d01e86aa9',
        'name' => '12 months',
        'accept_fee' => false,
    );

    public function getEntity()
    {
        return new PaymentOptionVariantEntity();
    }
}
