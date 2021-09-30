<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\Request
 *
 * @package Payever\ExternalIntegration\Tests\Plugin\Core\Http
 */
class RequestTest extends TestCase
{
    /** @var Request */
    private $request;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->request = new Request();
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @see \Payever\ExternalIntegration\Core\Http\Request::addHeader()
     * @see \Payever\ExternalIntegration\Core\Http\Request::removeHeader()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getHeader()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getHeaders()
     * @see \Payever\ExternalIntegration\Core\Http\Request::cleanHeaders()
     * @see \Payever\ExternalIntegration\Core\Http\Request::containsHeader()
     *
     * @dataProvider keyValueDataProvider
     */
    public function testHeaders($key, $value)
    {
        $this->assertEmpty($this->request->getHeaders());

        $this->assertFalse($this->request->containsHeader($key));

        $this->request->addHeader($key, $value);

        $this->assertTrue($this->request->containsHeader($key));
        $this->assertEquals($value, $this->request->getHeader($key));
        $this->assertEquals(array($key . ': ' . $value), $this->request->getHeaders());

        $this->request->removeHeader($key);

        $this->assertFalse($this->request->getHeader($key));
        $this->assertEmpty($this->request->getHeaders());

        $this->request->addHeader($key, $value);
        $this->request->cleanHeaders();

        $this->assertEmpty($this->request->getHeaders());
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @see \Payever\ExternalIntegration\Core\Http\Request::addParam()
     * @see \Payever\ExternalIntegration\Core\Http\Request::removeParam()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getParam()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getParams()
     * @see \Payever\ExternalIntegration\Core\Http\Request::cleanParams()
     * @see \Payever\ExternalIntegration\Core\Http\Request::containsParam()
     * @see \Payever\ExternalIntegration\Core\Http\Request::setParams()
     *
     * @dataProvider keyValueDataProvider
     */
    public function testParams($key, $value)
    {
        $this->assertEmpty($this->request->getParams());
        $this->assertFalse($this->request->containsParam($key));

        $this->request->addParam($key, $value);

        $this->assertTrue($this->request->containsParam($key));
        $this->assertEquals($value, $this->request->getParam($key));
        $this->assertEquals(array($key => $value), $this->request->getParams());

        $this->request->removeParam($key);

        $this->assertFalse($this->request->getParam($key));
        $this->assertEmpty($this->request->getParams());

        $this->request->addParam($key, $value);
        $this->request->cleanParams();

        $this->assertEmpty($this->request->getParams());

        $this->request->setParams(array($key => $value));
        $this->assertEquals(array($key => $value), $this->request->getParams());
    }

    /**
     * @return array
     */
    public function keyValueDataProvider()
    {
        return array(
            array('stub', 'stub_value'),
            array('Location', 'http://some.domain.com'),
            array('access_token', '2fjpkglmyeckg008oowckco4gscc4og4s0kogskk48k8o8wgscfjpkglmyeckg008oowckco4gscc4og4s0kogskk48k8o8wgsc'),
        );
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Request::getMethod()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getMethods()
     * @see \Payever\ExternalIntegration\Core\Http\Request::setMethod()
     */
    public function testHttpMethod()
    {
        $this->assertEquals(array('GET', 'POST'), Request::getMethods());

        $this->assertEquals(Request::METHOD_GET, $this->request->getMethod());

        $this->request->setMethod(Request::METHOD_POST);

        $this->assertEquals(Request::METHOD_POST, $this->request->getMethod());

        $this->request->setMethod();

        $this->assertEquals(Request::METHOD_GET, $this->request->getMethod());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Request::getUrl()
     * @see \Payever\ExternalIntegration\Core\Http\Request::setUrl()
     */
    public function testUrl()
    {
        $url = 'https://domain.com/some/path?ac=stub';

        $this->assertEmpty($this->request->getUrl());

        $this->request->setUrl($url);

        $this->assertEquals($url, $this->request->getUrl());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Request::setRequestEntity()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getRequestEntity()
     */
    public function testRequestEntity()
    {
        $this->assertNull($this->request->getRequestEntity());

        $reqEntity = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\RequestEntity')->getMock();

        $this->request->setRequestEntity($reqEntity);

        $this->assertEquals($reqEntity, $this->request->getRequestEntity());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Request::setResponseEntity()
     * @see \Payever\ExternalIntegration\Core\Http\Request::getResponseEntity()
     */
    public function testResponseEntity()
    {
        $this->assertNull($this->request->getResponseEntity());

        $respEntity = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\ResponseEntity')->getMock();

        $this->request->setResponseEntity($respEntity);

        $this->assertEquals($respEntity, $this->request->getResponseEntity());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Request::validate()
     */
    public function testValidate()
    {
        $reqEntity = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\RequestEntity')->getMock();
        $reqEntity->expects($this->any())->method('isValid')->willReturn(true);
        $this->request->setRequestEntity($reqEntity);

        $this->assertTrue($this->request->validate());
    }
}
