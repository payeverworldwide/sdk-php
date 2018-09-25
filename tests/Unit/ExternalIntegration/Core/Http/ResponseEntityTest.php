<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseEntityTest
 *
 * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity
 *
 * @package Payever\ExternalIntegration\Core\Http
 */
class ResponseEntityTest extends TestCase
{
    /**
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::setCall()
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::setResult()
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::isValid()
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::isSuccessful()
     *
     * @throws \Exception
     */
    public function testValidation()
    {
        $call = array(
            'created_at' => time(),
            'status' => 'success',
            'id' => bin2hex(random_bytes(16)),
        );
        $result = [];

        $responseEntity = new ResponseEntity();

        $responseEntity->setCall($call);
        $responseEntity->setResult($result);

        $this->assertInstanceOf('Payever\ExternalIntegration\Payments\Http\MessageEntity\CallEntity', $responseEntity->getCall());
        $this->assertInstanceOf('Payever\ExternalIntegration\Payments\Http\MessageEntity\ResultEntity', $responseEntity->getResult());
        $this->assertTrue($responseEntity->isSuccessful());
        $this->assertFalse($responseEntity->isFailed());
        $this->assertTrue($responseEntity->isValid());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::setError()
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::setErrorDescription()
     * @covers \Payever\ExternalIntegration\Core\Http\ResponseEntity::isFailed()
     */
    public function testError()
    {
        $error = "ERROR";
        $errorDescr = "ERROR_HAPPENED";

        $responseEntity = new ResponseEntity();
        $responseEntity->setError($error);
        $responseEntity->setErrorDescription($errorDescr);

        $this->assertTrue($responseEntity->isFailed());
        $this->assertFalse($responseEntity->isSuccessful());
        $this->assertEquals($error, $responseEntity->getError());
        $this->assertEquals($errorDescr, $responseEntity->getErrorDescription());
    }
}
