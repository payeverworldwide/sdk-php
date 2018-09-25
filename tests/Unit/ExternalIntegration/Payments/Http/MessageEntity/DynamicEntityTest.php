<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\DynamicEntity;

/**
 * Class DynamicEntityTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Http\MessageEntity\DynamicEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class DynamicEntityTest extends AbstractMessageEntityTest
{
    /**
     * Dynamic entity should should accept arbitrary scheme
     *
     * @var array
     */
    protected static $scheme = array(
        'dynamic_field' => 'value',
        'dynamic_field2' => 150.5,
        'field_is_not_declared' => true,
    );

    public function getEntity()
    {
        return new DynamicEntity();
    }
}
