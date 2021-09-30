<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * This class represents Authentication RequestInterface Entity
 *
 * @method string getScope()
 * @method string getClientId()
 * @method string getClientSecret()
 * @method string getGrantType()
 * @method string getRefreshToken()
 * @method self   setScope(string $scope)
 * @method self   setClientId(string $id)
 * @method self   setClientSecret(string $secret)
 * @method self   setGrantType(string $type)
 * @method self   setRefreshToken(string $scope)
 *
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class AuthenticationRequest extends RequestEntity
{
    /** @var string $scope */
    protected $scope = OauthToken::SCOPE_PAYMENT_ACTIONS;

    /** @var string $clientId */
    protected $clientId;

    /** @var string $clientSecret */
    protected $clientSecret;

    /** @var string $grantType */
    protected $grantType = OauthToken::GRAND_TYPE_OBTAIN_TOKEN;

    /** @var string $refreshToken */
    protected $refreshToken;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        $required = [
            'scope',
            'client_id',
            'client_secret',
            'grant_type',
        ];

        if ($this->grantType == OauthToken::GRAND_TYPE_REFRESH_TOKEN) {
            $required[] = 'refresh_token';
        }

        return $required;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            in_array($this->scope, OauthToken::getScopes()) &&
            in_array($this->grantType, OauthToken::getGrandTypes())
        ;
    }
}
