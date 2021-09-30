<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\ClientConfiguration;
use Payever\ExternalIntegration\Core\Enum\ChannelSet;
use Payever\ExternalIntegration\Core\Logger\NullLogger;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientConfigurationTest
 *
 * @see \Payever\ExternalIntegration\Core\ClientConfiguration
 *
 * @package Payever\ExternalIntegration\Core
 */
class ClientConfigurationTest extends TestCase
{
    /** @var ClientConfiguration $configuration */
    protected $configuration;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->configuration = new ClientConfiguration();

        parent::setUp();
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setChannelSet()
     */
    public function testSetChannelSetException()
    {
        $this->expectException(\Payever\ExternalIntegration\Core\Exception\ConfigurationException::class);
        $this->configuration->setChannelSet('unknown_channel');
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setChannelSet()
     *
     * @throws \Exception
     */
    public function testSetChannelSetConstraint()
    {
        $this->configuration->setChannelSet(ChannelSet::CHANNEL_MAGENTO);

        $this->assertEquals($this->configuration->getChannelSet(), 'magento');
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setChannelSet()
     *
     * @throws \Exception
     */
    public function testSetChannelSetString()
    {
        $this->configuration->setChannelSet('shopware');

        $this->assertEquals($this->configuration->getChannelSet(), ChannelSet::CHANNEL_SHOPWARE);
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getHash()
     */
    public function testHashDependencies()
    {
        $clientId = 'stub';
        $clientSecret = 'stub_secret';

        $expectedHash = md5($clientId . $clientSecret);

        $this->configuration->setClientId($clientId)->setClientSecret($clientSecret);

        $this->assertEquals($expectedHash, $this->configuration->getHash());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getApiMode()
     */
    public function testDefaultApiMode()
    {
        $defaultMode = ClientConfiguration::API_MODE_LIVE;

        $this->assertEquals($defaultMode, $this->configuration->getApiMode());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getChannelSet()
     */
    public function testDefaultChannelSet()
    {
        $defaultChannel = ChannelSet::CHANNEL_OTHER_SHOPSYSTEM;

        $this->assertEquals($defaultChannel, $this->configuration->getChannelSet());
    }

    /**
     * @param string $getFunc
     * @param string $setFunc
     * @param mixed $value
     *
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setBusinessUuid()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getBusinessUuid()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setClientId()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getClientId()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setClientSecret()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getClientSecret()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setCustomSandboxUrl()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getCustomSandboxUrl()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::setApiMode()
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::getApiMode()
     *
     * @dataProvider gettersSettersDataProvider
     */
    public function testGettersSetters($getFunc, $setFunc, $value, $defaultValue = null)
    {
        $this->assertEquals($defaultValue, $this->configuration->{$getFunc}());

        $this->configuration->{$setFunc}($value);

        $this->assertEquals($value, $this->configuration->{$getFunc}());
    }

    /**
     * @return array
     */
    public function gettersSettersDataProvider()
    {
        return array(
            array('getBusinessUuid', 'setBusinessUuid', 'business_uuid'),
            array('getClientId', 'setClientId', 'client_id'),
            array('getClientSecret', 'setClientSecret', 'client_secret'),
            array('getCustomSandboxUrl', 'setCustomSandboxUrl', 'https://sandbox.com/'),
            array('getCustomLiveUrl', 'setCustomLiveUrl', 'https://live.com/'),
            array('getApiMode', 'setApiMode', true, 'live'),
        );
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::isLoaded()
     *
     * @dataProvider isLoadedCasesDataProvider
     *
     * @throws \Exception
     */
    public function testIsLoaded($method, $value, $isLoaded)
    {
        $this->configuration->{$method}($value);

        self::assertEquals($isLoaded, $this->configuration->isLoaded());
    }

    /**
     * @return array
     */
    public function isLoadedCasesDataProvider()
    {
        return array(
            'no client_id' => array('setClientId', null, false),
            'with client_id' => array('setClientId', 'stub', false),
            'no client_secret' => array('setClientSecret', '', false),
            'with client_secret' => array('setClientSecret', 'stub', false),
            'no business uuid' => array('setBusinessUuid', 0, false),
            'with business uuid' => array('setBusinessUuid', 'stub', false),
        );
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::assertLoaded()
     */
    public function testAssertLoadedNegative()
    {
        $this->expectException(\Payever\ExternalIntegration\Core\Exception\ConfigurationException::class);
        $this->configuration->assertLoaded();
    }

    /**
     * @see \Payever\ExternalIntegration\Core\ClientConfiguration::assertLoaded()
     *
     * @doesNotPerformAssertions
     */
    public function testAssertLoadedPositive()
    {
        $this->configuration
            ->setClientId('stub')
            ->setClientSecret('stub')
            ->setBusinessUuid('stub')
        ;

        $this->configuration->assertLoaded();
    }

    public function testDefaultLogger()
    {
        $this->assertInstanceOf(NullLogger::class, $this->configuration->getLogger());
    }

    public function testLoggerChange()
    {
        $logger = new NullLogger();

        $this->configuration->setLogger($logger);

        $this->assertEquals(spl_object_hash($logger), spl_object_hash($this->configuration->getLogger()));
    }
}
