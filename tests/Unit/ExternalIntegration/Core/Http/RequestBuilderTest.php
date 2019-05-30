<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestBuilderTest
 *
 * @package Payever\ExternalIntegration\Core\Http
 */
class RequestBuilderTest extends TestCase
{

    const URL = 'https://some.domain.com/path/';

    public function testBuild()
    {
        $method = 'POST';
        $params = array(
            'one' => 'value1',
            'two' => 'value2',
        );
        $headerKey = 'Authotization';
        $headerValue = 'Bearer stub_token';

        $builder = new RequestBuilder();

        $builder->setUrl(static::URL)
            ->setParams($params)
            ->addHeader($headerKey, $headerValue)
            ->setMethod($method);

        $request = $builder->build();

        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals(static::URL, $request->getUrl());
        $this->assertEquals($params, $request->getParams());
        $this->assertContains("$headerKey: $headerValue", $request->getHeaders());
    }

    public function testHeaders()
    {
        $builder = new RequestBuilder();

        $builder->addHeader('key', 'value');
        $this->assertEquals('value', $builder->getHeader('key'));
        $this->assertTrue($builder->containsHeader('key'));

        $builder->addHeader('key2', 'value2');
        $this->assertTrue($builder->containsHeader('key2'));

        $builder->removeHeader('key2');
        $this->assertFalse($builder->containsHeader('key2'));
        $this->assertTrue($builder->containsHeader('key'));

        $builder->cleanHeaders();
        $this->assertEmpty($builder->getHeaders());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\RequestBuilder::get()
     */
    public function testGet()
    {
        $builder = RequestBuilder::get(static::URL);

        $this->assertEquals('GET', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\RequestBuilder::post()
     */
    public function testPost()
    {
        $builder = RequestBuilder::post(static::URL);

        $this->assertEquals('POST', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }

    public function testPut()
    {
        $builder = RequestBuilder::put(static::URL);

        $this->assertEquals('PUT', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }

    public function testPatch()
    {
        $builder = RequestBuilder::patch(static::URL);

        $this->assertEquals('PATCH', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }

    public function testDelete()
    {
        $builder = RequestBuilder::delete(static::URL);

        $this->assertEquals('DELETE', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }
}
