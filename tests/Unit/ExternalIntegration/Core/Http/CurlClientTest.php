<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\Client\CurlClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\LogLevel;

class CurlClientTest extends TestCase
{
    /**
     * @param $name
     *
     * @return bool|\ReflectionMethod
     */
    protected static function getMethod($name)
    {
        try {
            $class = new \ReflectionClass(CurlClient::class);
            $method = $class->getMethod($name);
            $method->setAccessible(true);

            return $method;
        } catch (\ReflectionException $e) {
            return false;
        }
    }

    public function testGetRequestOptions()
    {
        $method = self::getMethod('getRequestOptions');

        self::assertNotEquals(false, $method);

        $client = new CurlClient();
        $client->setLogLevel(LogLevel::NOTICE);
        $client->setLogLevelOnce(LogLevel::INFO);
        $options = array(
            CURLOPT_URL            => 'http://test.com',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => array('test' => true),
            CURLOPT_HTTPHEADER     => array('Authorization: Bearer test'),
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT        => 45,
            CURLOPT_CONNECTTIMEOUT => 30,
        );

        $result = $method->invokeArgs($client, array($options));

        self::assertEquals(
            array(
                CURLOPT_URL            => 'http://test.com',
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => array('test' => true),
                CURLOPT_HTTPHEADER     => array('Authorization: Bearer test'),
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_TIMEOUT        => 45,
                CURLOPT_CONNECTTIMEOUT => 30,
            ),
            $result
        );
    }
}
