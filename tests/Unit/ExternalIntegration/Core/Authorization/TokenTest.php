<?php

namespace Payever\Tests\Unit\ExternalIntegration\Core\Authorization;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use PHPUnit\Framework\TestCase;

/**
 * Class TokenTest
 *
 * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken
 *
 * @package Payever\ExternalIntegration\Core\Authorization
 */
class TokenTest extends TestCase
{
    /** @var OauthToken */
    private $token;

    /**
     * @throws \Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->token = new OauthToken();
    }

    private function getTokenFields()
    {
        return array(
            'scope'         => OauthToken::SCOPE_CREATE_PAYMENT,
            'access_token'  => 'stub_access_token',
            'refresh_token' => 'stub_refresh_token',
            'created_at'    => time(),
            'updated_at'    => time(),
        );
    }

    /**
     * @throws \Exception
     */
    public function testLoadOnConstruct()
    {
        $fields = $this->getTokenFields();
        $token = new OauthToken($fields);

        $this->assertEquals($fields, $token->getParams());
    }

    /**
     * @throws \Exception
     */
    public function testLoadFields()
    {
        $fields = $this->getTokenFields();
        $token = new OauthToken();

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
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::load()
     */
    public function testLoadFailedBadJson()
    {
        $this->expectException(\Exception::class);
        $token = new OauthToken();

        $token->load("[\"\"access_token\": \"stub\"]");
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::getHash()
     *
     * @throws \Exception
     */
    public function testGetHash()
    {
        $fields = $this->getTokenFields();
        $token = new OauthToken($fields);

        $expectedHash = md5(json_encode($fields));

        $this->assertEquals($expectedHash, $token->getHash());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::isExpired()
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::getExpiresIn()
     *
     * @throws \Exception
     */
    public function testIsExpired()
    {
        $token = new OauthToken();

        $this->assertEquals(0, $token->getExpiresIn());
        $this->assertFalse($token->isExpired());

        $token->load($this->getTokenFields());

        $token->setUpdatedAt(time() - OauthToken::ACCESS_TOKEN_LIFETIME);

        $this->assertTrue($token->isExpired());

        // 1 sec difference should matter
        $token->setUpdatedAt(time() - OauthToken::ACCESS_TOKEN_LIFETIME + 1);

        $this->assertFalse($token->isExpired());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::isRefreshable()
     *
     * @throws \Exception
     */
    public function testIsRefreshable()
    {
        $token = new OauthToken();

        $this->assertFalse($token->isRefreshable());

        $token->load($this->getTokenFields());

        $token->setUpdatedAt(time() - OauthToken::REFRESH_TOKEN_LIFETIME);

        $this->assertFalse($token->isRefreshable());

        $token->setUpdatedAt(time() - OauthToken::REFRESH_TOKEN_LIFETIME + 1);

        $this->assertTrue($token->isRefreshable());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::getScopes()
     */
    public function testGetScopes()
    {
        $scopes = array(
            'API_PAYMENT_ACTIONS',
            'API_CREATE_PAYMENT',
            'API_PAYMENT_INFO',
        );

        $this->assertEquals($scopes, OauthToken::getScopes());
    }

    /**
     * @see \Payever\ExternalIntegration\Core\Authorization\OauthToken::getGrandTypes()
     */
    public function testGrantTypes()
    {
        $this->assertEquals(
            array('refresh_token', 'http://www.payever.de/api/payment'),
            OauthToken::getGrandTypes()
        );
    }
}
