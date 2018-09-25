<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Authorization;

use Payever\Tests\Bootstrap\Plugin\Core\Authorization\Token;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenTest
 *
 * @covers \Payever\ExternalIntegration\Core\Authorization\Token
 *
 * @package Payever\ExternalIntegration\Core\Authorization
 */
class TokenTest extends TestCase
{
    /** @var Token */
    private $token;

    public function setUp()
    {
        parent::setUp();

        $this->token = $this->getMockForAbstractClass('Payever\Tests\Bootstrap\Plugin\Core\Authorization\Token');
    }

    private function getTokenFields()
    {
        return array(
            'scope'         => Token::SCOPE_CREATE_PAYMENT,
            'access_token'  => 'stub_access_token',
            'refresh_token' => 'stub_refresh_token',
            'created_at'    => time(),
            'updated_at'    => time(),
        );
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::__construct()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::load()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getParams()
     *
     * @throws \Exception
     */
    public function testLoadOnConstruct()
    {
        $fields = $this->getTokenFields();
        $token = new Token($fields);

        $this->assertEquals($fields, $token->getParams());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::load()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getCreatedAt()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getUpdatedAt()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getAccessToken()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getRefreshToken()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getScope()
     *
     * @throws \Exception
     */
    public function testLoadFields()
    {
        $fields = $this->getTokenFields();
        $token = new Token();

        $this->assertNotEmpty($token->getCreatedAt());
        $this->assertEmpty($token->getUpdatedAt());
        $this->assertEmpty($token->getAccessToken());
        $this->assertEmpty($token->getRefreshToken());
        $this->assertEmpty($token->getScope());

        $token->load($fields);

        $this->assertEquals($fields, $token->getParams());

        $this->assertEquals($fields['scope'], $token->getScope());
        $this->assertEquals($fields['access_token'], $token->getAccessToken());
        $this->assertEquals($fields['refresh_token'], $token->getRefreshToken());
        $this->assertEquals($fields['created_at'], $token->getCreatedAt());
        $this->assertEquals($fields['updated_at'], $token->getUpdatedAt());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::load()
     *
     * @expectedException  \Exception
     */
    public function testLoadFailedBadJson()
    {
        $token = new Token();

        $token->load("[\"\"access_token\": \"stub\"]");
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getHash()
     *
     * @throws \Exception
     */
    public function testGetHash()
    {
        $fields = $this->getTokenFields();
        $token = new Token($fields);

        $expectedHash = md5(json_encode($fields));

        $this->assertEquals($expectedHash, $token->getHash());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::isExpired()
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getExpiresIn()
     *
     * @throws \Exception
     */
    public function testIsExpired()
    {
        $token = new Token();

        $this->assertFalse($token->getExpiresIn());
        $this->assertFalse($token->isExpired());

        $token->load($this->getTokenFields());

        $token->setUpdatedAt(time()-Token::ACCESS_TOKEN_LIFETIME);

        $this->assertTrue($token->isExpired());

        // 1 sec difference should matter
        $token->setUpdatedAt(time()-Token::ACCESS_TOKEN_LIFETIME + 1);

        $this->assertFalse($token->isExpired());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::isRefreshable()
     *
     * @throws \Exception
     */
    public function testIsRefreshable()
    {
        $token = new Token();

        $this->assertFalse($token->isRefreshable());

        $token->load($this->getTokenFields());

        $token->setUpdatedAt(time() - Token::REFRESH_TOKEN_LIFETIME);

        $this->assertFalse($token->isRefreshable());

        $token->setUpdatedAt(time() - Token::REFRESH_TOKEN_LIFETIME + 1);

        $this->assertTrue($token->isRefreshable());
    }

    /**
     * @covers \Payever\ExternalIntegration\Core\Authorization\Token::getScopes()
     */
    public function testGetScopes()
    {
        $scopes = array(
            'API_PAYMENT_ACTIONS',
            'API_CREATE_PAYMENT',
            'API_PAYMENT_INFO',
        );

        $this->assertEquals($scopes, Token::getScopes());
    }
}
