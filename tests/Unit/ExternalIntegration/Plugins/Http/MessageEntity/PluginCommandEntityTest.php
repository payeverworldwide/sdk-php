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
        'minCmsVersion' => '5.0.0',
        'maxCmsVersion' => '5.99.0',
        'channelType' => 'shopware',
        'metadata' => [
            'filename' => 'https://some.host/download',
            'marketplace' => 'https://marketplce.some.host',
            'releaseNotes' => '- Added lots of features',
        ],
    ];

    public function getEntity()
    {
        return new PluginCommandEntity();
    }

    public function testMeta()
    {
        $command = $this->getEntity()->load($this->getScheme());

        $this->assertNull($command->getMeta('non-existent-meta'));
        $this->assertEquals('- Added lots of features', $command->getMeta('releaseNotes'));

        $setResult = $command->setMeta('value', 'custom-meta');
        $this->assertInstanceOf(PluginCommandEntity::class, $setResult);
        $this->assertEquals('custom-meta', $command->getMeta('value'));
    }
}
