<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Helper;

use Payever\ExternalIntegration\Core\Helper\StringHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class StringHelperTest
 *
 * @see \Payever\ExternalIntegration\Core\Helper\StringHelper
 *
 * @package Payever\ExternalIntegration\Core\Helper
 */
class StringHelperTest extends TestCase
{
    /**
     * @param $in
     * @param $out
     *
     * @dataProvider underscoreCasesDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Helper\StringHelper::underscore()
     */
    public function testUnderscore($in, $out)
    {
        $this->assertEquals($out, StringHelper::underscore($in));
    }

    /**
     * @return array
     */
    public function underscoreCasesDataProvider()
    {
        return array(
            array('helloWorld', 'hello_world'),
            array('HelloWorld', 'hello_world'),
            array('_HelloWorld', '__hello_world'),
            array('LongCamelCaseString', 'long_camel_case_string'),
            array('', ''),
            array(null, ''),
            array(false, ''),
            array(true, '1'),
        );
    }

    /**
     * @param string $in
     * @param string $out
     * @param bool $ucFirst
     *
     * @dataProvider camelizeCasesDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Helper\StringHelper::camelize()
     */
    public function testCamelize($in, $out, $ucFirst = false)
    {
        $this->assertEquals($out, StringHelper::camelize($in, $ucFirst));
    }

    /**
     * @return array
     */
    public function camelizeCasesDataProvider()
    {
        return array(
            array('hello_world', 'helloWorld'),
            array('hello_world', 'HelloWorld', true),
            array('Hello_world', 'helloWorld'),
            array('_Hello_world', 'helloWorld'),
            array('very_long_underscore_string', 'VeryLongUnderscoreString', true),
            array('even_longer_very_long_underscore_string', 'evenLongerVeryLongUnderscoreString'),
            array('HelloWorld', 'helloWorld'),
            array('HelloWorld', 'HelloWorld', true),
            array('', ''),
            array(null, ''),
            array(false, ''),
        );
    }

    /**
     * @param string $in
     * @param string $out
     * @param bool $exception
     *
     * @throws \Exception
     *
     * @dataProvider jsonDecodeDataProvider
     *
     * @see \Payever\ExternalIntegration\Core\Helper\StringHelper::jsonDecode()
     */
    public function testJsonDecode($in, $out, $exception = false)
    {
        if ($exception) {
            $this->expectException('Exception');
        }

        $this->assertEquals($out, StringHelper::jsonDecode($in));
    }

    /**
     * @return array
     */
    public function jsonDecodeDataProvider()
    {
        return array(
            array('[1,2,\']', false, true),
            array('', false, true),
            array('[1,2,3]', array(1,2,3)),
            array('[]', false),
            array(1, 1),
            array(null, null),
            array(false, false),
            array(true, true),
        );
    }
}
