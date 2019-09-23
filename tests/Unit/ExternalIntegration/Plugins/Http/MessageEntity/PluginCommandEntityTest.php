<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Http\MessageEntity;

use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class PluginCommandEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = [
        '_id' => 'stub_id',
        'name' => PluginCommandNameEnum::SET_LIVE_HOST,
        'value' => 'https://some.host.com/',
    ];

    public function getEntity()
    {
        return new PluginCommandEntity();
    }
}
