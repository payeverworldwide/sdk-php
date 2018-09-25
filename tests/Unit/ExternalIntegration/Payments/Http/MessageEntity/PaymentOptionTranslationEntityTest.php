<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionTranslationEntity;

/**
 * Class PaymentOptionTranslationEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentOptionTranslationEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class PaymentOptionTranslationEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'locale' => 'de',
        'field' => 'stub_field',
        'content' => 'stub_content',
    );

    public function getEntity()
    {
        return new PaymentOptionTranslationEntity();
    }
}
