<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\CurlClient;
use PHPUnit\Framework\TestCase;

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
            $class = new \ReflectionClass('Payever\ExternalIntegration\Core\Http\CurlClient');

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
        $options = array(
            CURLOPT_URL            => 'http://test.com',
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => array('test' => true),
            CURLOPT_HTTPHEADER     => array('Authorization: Bearer test'),
            CURLOPT_HTTP_VERSION   => 1.1,
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
                CURLOPT_HTTP_VERSION   => 1.1,
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_TIMEOUT        => 45,
                CURLOPT_CONNECTTIMEOUT => 30,
            ),
            $result
        );
    }
}
