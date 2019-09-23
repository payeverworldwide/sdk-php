<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\PluginRegistryResponseEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Plugins\Http\RequestEntity\PluginRegistryRequestEntityTest;

class PluginRegistryResponseEntityTest extends AbstractMessageEntityTest
{
    public static function getScheme()
    {
        static::$scheme = PluginRegistryRequestEntityTest::getScheme();
        static::$scheme['_id'] = 'stub-id';

        return parent::getScheme();
    }

    public function getEntity()
    {
        return new PluginRegistryResponseEntity();
    }
}
