<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestBuilderTest
 *
 * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder
 *
 * @package Payever\ExternalIntegration\Core\Http
 */
class RequestBuilderTest extends TestCase
{

    const URL = 'https://some.domain.com/path/';

    /**
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::build()
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::setUrl()
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::setMethod()
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::setParams()
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::setHeaders()
     */
    public function testBuild()
    {
        $method = 'POST';
        $params = array(
            'one' => 'value1',
            'two' => 'value2',
        );
        $headers = array(
            'Authotization' => 'Bearer stub_token',
        );

        $builder = new RequestBuilder();

        $builder->setUrl(static::URL)
            ->setParams($params)
            ->setHeaders($headers)
            ->setMethod($method);

        $request = $builder->build();

        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals(static::URL, $request->getUrl());
        $this->assertEquals($params, $request->getParams());
        $this->assertEquals($headers, $request->getHeaders());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::get()
     */
    public function testGet()
    {
        $builder = RequestBuilder::get(static::URL);

        $this->assertEquals('GET', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Http\RequestBuilder::post()
     */
    public function testPost()
    {
        $builder = RequestBuilder::post(static::URL);

        $this->assertEquals('POST', $builder->getMethod());
        $this->assertEquals(static::URL, $builder->getUrl());
    }
}
