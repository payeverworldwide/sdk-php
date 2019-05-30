<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @see \Payever\ExternalIntegration\Core\Http\Response
 *
 * @package Payever\ExternalIntegration\Core\Http
 */
class ResponseTest extends TestCase
{
    /**
     * @return array
     */
    public function jsonDataProvider()
    {
        return array(
            'successful' => array('{"call": {}, "result": {}}', true),
            'contains error' => array('{"call": {}, "result": {}, "error": "ERROR"}', false),
        );
    }

    /**
     * @param string $json
     *
     * @see \Payever\ExternalIntegration\Core\Http\Response::__construct()
     * @see \Payever\ExternalIntegration\Core\Http\Response::load()
     * @see \Payever\ExternalIntegration\Core\Http\Response::getData()
     *
     * @dataProvider jsonDataProvider
     *
     * @return Response
     */
    public function testLoad($json)
    {
        $response = new Response();
        $response->load($json);

        $this->assertEquals($json, $response->getData());

        return $response;
    }

    /**
     * @param string $json
     * @param bool $positive
     *
     * @see \Payever\ExternalIntegration\Core\Http\Response::isSuccessful()
     *
     * @dataProvider jsonDataProvider
     */
    public function testIsSuccessful($json, $positive = true)
    {
        $response = new Response();
        $response->load($json);

        if ($positive) {
            $this->assertTrue($response->isSuccessful());
        } else {
            $this->assertFalse($response->isSuccessful());
        }
    }

    /**
     * @param string $json
     * @param bool $positive
     *
     * @see \Payever\ExternalIntegration\Core\Http\Response::isFailed()
     *
     * @dataProvider jsonDataProvider
     */
    public function testIsFailed($json, $positive = true)
    {
        $response = new Response();
        $response->load($json);

        if (!$positive) {
            $this->assertTrue($response->isFailed());
        } else {
            $this->assertFalse($response->isFailed());
        }
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Response::getRequestEntity()
     * @see \Payever\ExternalIntegration\Core\Http\Response::setRequestEntity()
     */
    public function testRequestEntityConnection()
    {
        $response = new Response();

        $reqEntity = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\RequestEntity')->getMock();
        $reqEntity->expects($this->any())->method('isValid')->willReturn(true);

        $this->assertNull($response->getRequestEntity());

        $response->setRequestEntity($reqEntity);

        $this->assertEquals($reqEntity, $response->getRequestEntity());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Http\Response::getResponseEntity()
     * @see \Payever\ExternalIntegration\Core\Http\Response::setResponseEntity()
     */
    public function testResponseEntityConnection()
    {
        $response = new Response();

        $respEntity = $this->getMockBuilder('Payever\ExternalIntegration\Core\Http\ResponseEntity')->getMock();
        $respEntity->expects($this->any())->method('isValid')->willReturn(true);

        $this->assertNotNull($response->getResponseEntity());

        $response->setResponseEntity($respEntity);

        $this->assertEquals($respEntity, $response->getResponseEntity());
    }
}
