<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Plugins\Command\AbstractPluginCommandExecutor;
use Payever\ExternalIntegration\Plugins\Enum\PluginCommandNameEnum;
use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;
use Payever\Tests\Bootstrap\TestCase;

class PluginCommandExecutorTest extends TestCase
{
    /** @var AbstractPluginCommandExecutor */
    private $pluginCommandExecutor;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->pluginCommandExecutor = $this->getMockForAbstractClass(AbstractPluginCommandExecutor::class);
    }

    /**
     * @param string $host
     * @param bool $isValid
     *
     * @dataProvider apiHostDataProvider
     *
     * @throws \ReflectionException
     */
    public function testAssertApiHostValid($host, $isValid)
    {
        if ($isValid) {
            $this->expectNotToPerformAssertions();
        } else {
            $this->expectException(\UnexpectedValueException::class);
        }

        $this->invokeProtectedMethod($this->pluginCommandExecutor, 'assertApiHostValid', [$host]);
    }

    public function apiHostDataProvider()
    {
        return [
            ['https://some.host', true],
            ['https://sandbox.payever.de', true],
            ['https://proxy.payever.org', true],
            ['not-a-host', false],
            ['https:not-a-host', false],
            ['https://not_a_host', false],
        ];
    }

    /**
     * @param PluginCommandEntity $command
     * @param $delimiter
     * @param $expectedResult
     *
     * @dataProvider pluginVersionNotificationDataProvider
     *
     * @throws \ReflectionException
     */
    public function testGetNewPluginVersionNotificationText(
        PluginCommandEntity $command,
        $delimiter,
        $expectedResult
    ) {
        $this->assertEquals(
            $expectedResult,
            $this->invokeProtectedMethod(
                $this->pluginCommandExecutor,
                'getNewPluginVersionNotificationText',
                [$command, $delimiter]
            )
        );
    }

    public function pluginVersionNotificationDataProvider()
    {
        return [
            [
                new PluginCommandEntity([
                    'name' => PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION,
                    'value' => '1.0.0',
                    'metadata' => [],
                ]),
                '. ',
                'New payever plugin version is available: 1.0.0',
            ],
            [
                new PluginCommandEntity([
                    'name' => PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION,
                    'value' => '2.0.0',
                    'metadata' => [
                        'filename' => 'http://donwload.link.host',
                    ],
                ]),
                '. ',
                'New payever plugin version is available: 2.0.0. You can download it <a href="http://donwload.link.host" target="_blank">here</a>',
            ],
            [
                new PluginCommandEntity([
                    'name' => PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION,
                    'value' => '3.0.0',
                    'metadata' => [
                        'marketplaceLink' => 'https://marketeplace.com/payever',
                        'releaseNotes' => '- New awesome features!',
                    ],
                ]),
                '. ',
                'New payever plugin version is available: 3.0.0. You can also find this update <a href="https://marketeplace.com/payever" target="_blank">in marketplace</a>. This update includes: - New awesome features!',
            ],
            [
                new PluginCommandEntity([
                    'name' => PluginCommandNameEnum::NOTIFY_NEW_PLUGIN_VERSION,
                    'value' => '4.0.0',
                    'metadata' => [
                        'callToAction' => 'UPDATE NOW!',
                        'releaseNotes' => '- New awesome features!',
                    ],
                ]),
                '. ',
                'New payever plugin version is available: 4.0.0. This update includes: - New awesome features!. UPDATE NOW!',
            ],
        ];
    }
}
