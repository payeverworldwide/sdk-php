<?php
/**
 * This class represents Authentication Response Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Authorization\Token;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents List Payments Request Entity
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
    protected $scope = Token::SCOPE_PAYMENT_ACTIONS;

    /** @var string $tokenType */
    protected $tokenType = 'bearer';

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        $required = array(
            'access_token',
            'refresh_token',
            'scope',
        );

        return $required;
    }
}
