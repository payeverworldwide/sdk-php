<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core;

use Payever\ExternalIntegration\Core\Authorization\DummyOauthTokenList;
use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\Authorization\OauthTokenList;
use Payever\ExternalIntegration\Core\Base\ClientConfigurationInterface;
use Payever\ExternalIntegration\Core\Base\CommonApiClientInterface;
use Payever\ExternalIntegration\Core\Base\HttpClientInterface;
use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;
use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Core\Http\Client\CurlClient;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Core\Http\RequestEntity\AuthenticationRequest;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\AuthenticationResponse;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\GetCurrenciesResponse;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\ListChannelSetsResponse;
use Psr\Log\LoggerAwareInterface;

class CommonApiClient implements CommonApiClientInterface
{
    const URL_SANDBOX = 'https://proxy.staging.devpayever.com/';
    const URL_LIVE    = 'https://proxy.payever.org/';

    const SUB_URL_AUTH              = 'oauth/v2/token';
    const SUB_URL_LIST_CHANNEL_SETS = 'api/shop/%s/channel-sets';
    const SUB_URL_CURRENCY          = 'api/rest/v1/currency';

    /**
     * Stores oAuth Authentication Tokens
     *
     * @var OauthTokenList $tokens
     */
    protected $tokens;

    /**
     * Stores API Configuration
     *
     * @var ClientConfigurationInterface $configuration
     */
    protected $configuration;

    /**
     * Stores current Client
     *
     * @var HttpClientInterface $httpClient
     */
    protected $httpClient;

    /**
     * Payever Payments API Instance constructor
     *
     * @param ClientConfigurationInterface $clientConfiguration
     * @param OauthTokenList $oauthTokenList
     * @param HttpClientInterface $httpClient
     *
     * @throws \Exception
     */
    public function __construct(
        ClientConfigurationInterface $clientConfiguration,
        OauthTokenList $oauthTokenList = null,
        HttpClientInterface $httpClient = null
    ) {
        $this->configuration = $clientConfiguration;
        $this->httpClient = $httpClient;
        $this->loadTokens($oauthTokenList);
    }

    /**
     * Returns Base URL to payever Payments API
     *
     * @return string
     */
    public function getBaseUrl()
    {
        switch ($this->configuration->getApiMode()) {
            case ClientConfiguration::API_MODE_SANDBOX:
                $url = $this->configuration->getCustomSandboxUrl() ?: static::URL_SANDBOX;
                break;
            case ClientConfiguration::API_MODE_LIVE:
            default:
                $url = $this->configuration->getCustomLiveUrl() ?: static::URL_LIVE;
                break;
        }

        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        return $url;
    }

    /**
     * Returns current configuration
     *
     * @return ClientConfigurationInterface
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Returns current OauthToken list
     *
     * @return OauthTokenList
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Overrides configuration
     *
     * @param ClientConfigurationInterface $configuration
     */
    public function setConfiguration(ClientConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;

        $this->getTokens()->clear()->save();
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new CurlClient();
        }

        if ($this->httpClient instanceof LoggerAwareInterface) {
            $this->httpClient->setLogger($this->configuration->getLogger());
        }

        return $this->httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->configuration->getLogger()->debug(
            sprintf('Got new HTTP Client: %s', get_class($httpClient))
        );

        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Returns Authentication OauthToken
     *
     * @param string $scope OauthToken scope
     *
     * @return OauthTokenInterface
     *
     * @throws \Exception
     */
    public function getToken($scope = OauthTokenInterface::SCOPE_PAYMENT_ACTIONS)
    {
        $key = md5($this->getConfiguration()->getHash() . $scope);

        $this->configuration->getLogger()->debug(sprintf('Getting OAuth token. Hash: %s', $key));

        /** @var OauthTokenInterface|boolean $token */
        $token = $this->getTokens()->get($key);

        if (!$token || ($token->isExpired() && !$token->isRefreshable())) {
            $tokenData = $this->obtainTokenRequest($scope)->getResponseEntity()->toArray();

            $token = $this->getTokens()->add(
                $key,
                $this->getTokens()->create()->load($tokenData)->setUpdatedAt()
            )->get($key);

            $this->getTokens()->save();
        } elseif ($token->isExpired() && $token->isRefreshable()) {
            $tokenData = $this->refreshTokenRequest($token)->getResponseEntity()->toArray();

            $token->load($tokenData)->setUpdatedAt();

            $this->getTokens()->save();
        }

        $this->configuration->getLogger()->debug(
            sprintf('Got OAuth token. Hash: %s', $key),
            $token->getParams()
        );

        return $token;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function getCurrenciesRequest($lang = '')
    {
        $request = RequestBuilder::get($this->getCurrenciesURL($lang))
            ->setResponseEntity(new GetCurrenciesResponse())
            ->build()
        ;

        $response = $this->getHttpClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function listChannelSetsRequest($businessUuid)
    {
        $this->configuration->assertLoaded();

        $request = RequestBuilder::get($this->getListChannelSetsURL($businessUuid))
            ->setResponseEntity(new ListChannelSetsResponse())
            ->build()
        ;

        $response = $this->getHttpClient()->execute($request);

        return $response;
    }

    /**
     * Loads Tokens
     *
     * @param OauthTokenList|null $oauthTokenList
     *
     * @return $this
     */
    protected function loadTokens(OauthTokenList $oauthTokenList = null)
    {
        if (is_null($oauthTokenList)) {
            $oauthTokenList = new DummyOauthTokenList();
        }

        $this->tokens = $oauthTokenList->load();

        return $this;
    }

    /**
     * Requests new oAuth OauthToken which will be used further
     *
     * @link https://getpayever.com/developer/api-documentation/#authentication Documentation
     *
     * @param string $scope Scope in which the token will be used
     *
     * @return ResponseInterface
     *
     * @throws \Exception
     */
    protected function obtainTokenRequest($scope)
    {
        $this->configuration->assertLoaded();

        if (!in_array($scope, OauthToken::getScopes())) {
            throw new \Exception('Scope provided is not valid');
        }

        $requestEntity = new AuthenticationRequest();
        $requestEntity
            ->setClientId($this->configuration->getClientId())
            ->setClientSecret($this->configuration->getClientSecret())
            ->setScope($scope)
            ->setGrantType(OauthTokenInterface::GRAND_TYPE_OBTAIN_TOKEN)
        ;

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setRequestEntity($requestEntity)
            ->setResponseEntity(new AuthenticationResponse())
            ->build()
        ;

        $response = $this->getHttpClient()->execute($request);

        return $response;
    }

    /**
     * Requests for an updated oAuth OauthToken data
     *
     * @param OauthTokenInterface|object|array $token OauthToken for the update
     *
     * @return ResponseInterface
     *
     * @throws \Exception
     */
    protected function refreshTokenRequest(OauthTokenInterface $token)
    {
        $this->configuration->assertLoaded();

        $requestEntity = new AuthenticationRequest();
        $requestEntity
            ->setClientId($this->configuration->getClientId())
            ->setClientSecret($this->configuration->getClientSecret())
            ->setScope($token->getScope())
            ->setGrantType(OauthTokenInterface::GRAND_TYPE_REFRESH_TOKEN)
            ->setRefreshToken($token->getRefreshToken())
        ;

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setRequestEntity($requestEntity)
            ->setResponseEntity(new AuthenticationResponse())
            ->build()
        ;

        $response = $this->getHttpClient()->execute($request);

        return $response;
    }

    /**
     * Returns URL for Authentication path
     *
     * @return string
     */
    protected function getAuthenticationURL()
    {
        return $this->getBaseUrl() . self::SUB_URL_AUTH;
    }

    /**
     * Returns URL for Available Channel Sets path
     *
     * @param string $businessUuid
     *
     * @return string
     */
    protected function getListChannelSetsURL($businessUuid)
    {
        return $this->getBaseUrl() . sprintf(self::SUB_URL_LIST_CHANNEL_SETS, $businessUuid);
    }

    /**
     * Returns URL to Currencies path
     *
     * @param string $lang
     *
     * @return string
     */
    protected function getCurrenciesURL($lang = '')
    {
        return $this->getBaseUrl() . self::SUB_URL_CURRENCY . (empty($lang) ? '' : '?_locale=' . $lang);
    }
}
