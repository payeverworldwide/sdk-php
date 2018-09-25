<?php
/**
 * This class represents Authentication Request Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Authorization\Token;
use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Payments\Api;

/**
 * This class represents Authentication Request Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
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
 */
class AuthenticationRequest extends RequestEntity
{
    /** @var string $scope */
    protected $scope = Token::SCOPE_PAYMENT_ACTIONS;

    /** @var string $clientId */
    protected $clientId;

    /** @var string $clientSecret */
    protected $clientSecret;

    /** @var string $grantType */
    protected $grantType = Api::GRAND_TYPE_OBTAIN_TOKEN;

    /** @var string $refreshToken */
    protected $refreshToken;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        $required = array(
            'scope',
            'client_id',
            'client_secret',
            'grant_type',
        );

        if ($this->grantType == Api::GRAND_TYPE_REFRESH_TOKEN) {
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
            in_array($this->scope, Token::getScopes()) &&
            in_array($this->grantType, Api::getGrandTypes())
        ;
    }
}
