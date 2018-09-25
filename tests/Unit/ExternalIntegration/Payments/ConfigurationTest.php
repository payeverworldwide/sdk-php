<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\ChannelSet;
use Payever\ExternalIntegration\Payments\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationTest
 *
 * @covers \Payever\ExternalIntegration\Payments\Configuration
 *
 * @package Payever\ExternalIntegration\Payments
 */
class ConfigurationTest extends TestCase
{
    /** @var Configuration $configuration */
    protected $configuration;

    protected function setUp()
    {
        $this->configuration = self::getMockForAbstractClass('Payever\ExternalIntegration\Payments\Configuration');

        parent::setUp();
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setChannelSet()
     *
     * @expectedException \Exception
     */
    public function testSetChannelSetException()
    {
        $this->configuration->setChannelSet('unknown_channel');
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setChannelSet()
     *
     * @throws \Exception
     */
    public function testSetChannelSetConstraint()
    {
        $this->configuration->setChannelSet(ChannelSet::CHANNEL_MAGENTO);

        $this->assertEquals($this->configuration->getChannelSet(), 'magento');
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setChannelSet()
     *
     * @throws \Exception
     */
    public function testSetChannelSetString()
    {
        $this->configuration->setChannelSet('shopware');

        $this->assertEquals($this->configuration->getChannelSet(), ChannelSet::CHANNEL_SHOPWARE);
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getHash()
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
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getApiMode()
     */
    public function testDefaultApiMode()
    {
        $defaultMode = Configuration::MODE_SANDBOX;

        $this->assertEquals($defaultMode, $this->configuration->getApiMode());
    }

    /**
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getChannelSet()
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
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setSlug()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getSlug()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setClientId()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getClientId()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setClientSecret()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getClientSecret()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setSandboxUrl()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getSandboxUrl()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getDebugMode()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setDebugMode()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::setApiMode()
     * @covers \Payever\ExternalIntegration\Payments\Configuration::getApiMode()
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
            array('getSlug', 'setSlug', 'slug'),
            array('getClientId', 'setClientId', 'client_id'),
            array('getClientSecret', 'setClientSecret', 'client_secret'),
            array('getSandboxUrl', 'setSandboxUrl', 'https://sandbox.com/'),
            array('getDebugMode', 'setDebugMode', true, true),
            array('getApiMode', 'setApiMode', true, 'sandbox'),
        );
    }
}
