<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents List Payments RequestInterface Entity
 *
 * @method string getAccessToken()
 * @method string getRefreshToken()
 * @method int    getExpiresIn()
 * @method string getScope()
 * @method string getTokenType()
 * @method self   setAccessToken(string $token)
 * @method self   setRefreshToken(string $token)
 * @method self   setExpiresIn(int $seconds)
 * @method self   setScope(string $scope)
 * @method self   setTokenType(string $type)
 */
class AuthenticationResponse extends ResponseEntity
{
    /** @var string $accessToken */
    protected $accessToken;

    /** @var string $refreshToken */
    protected $refreshToken;

    /** @var int $expiresIn */
    protected $expiresIn = 0;

    /** @var string $scope */
    protected $scope = OauthToken::SCOPE_PAYMENT_ACTIONS;

    /** @var string $tokenType */
    protected $tokenType = 'Bearer';

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return [
            'access_token',
            'refresh_token',
            'scope',
        ];
    }
}
