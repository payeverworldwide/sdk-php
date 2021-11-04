<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Core
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
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
use Payever\ExternalIntegration\Core\Http\Request;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Core\Http\RequestEntity\AuthenticationRequest;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\AuthenticationResponse;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\GetCurrenciesResponse;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\ListChannelSetsResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LogLevel;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.MissingImport)
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class CommonApiClient implements CommonApiClientInterface
{
    const URL_SANDBOX = 'https://proxy.staging.devpayever.com/';
    const URL_LIVE    = 'https://proxy.payever.org/';

    const SUB_URL_AUTH              = 'oauth/v2/token';
    const SUB_URL_LIST_CHANNEL_SETS = 'api/shop/oauth/%s/channel-sets';
    const SUB_URL_CURRENCY          = 'api/rest/v1/currency';

    const FORBIDDEN_ERROR_CODE = 403;

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
        return $this->getBaseEntrypoint(true);
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
     * @param string $logLevel
     * @return $this
     */
    public function setHttpClientRequestFailureLogLevel($logLevel = LogLevel::CRITICAL)
    {
        if ($this->getHttpClient() instanceof CurlClient) {
            $this->getHttpClient()->setLogLevel($logLevel);
        }

        return $this;
    }

    /**
     * @param string $logLevel
     * @return $this
     */
    public function setHttpClientRequestFailureLogLevelOnce($logLevel)
    {
        if ($this->getHttpClient() instanceof CurlClient) {
            $this->getHttpClient()->setLogLevelOnce($logLevel);
        }

        return $this;
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

        /** @var OauthTokenInterface $token */
        $token = $this->getTokens()->get($key);

        if (!$token || ($token instanceof OauthTokenInterface && $token->isExpired() && !$token->isRefreshable())) {
            $tokenData = $this->obtainTokenRequest($scope)->getResponseEntity()->toArray();
            /** @var OauthTokenInterface $token */
            $token = $this->getTokens()->add(
                $key,
                $this->getTokens()->create()->load($tokenData)->setUpdatedAt()
            )->get($key);

            $this->getTokens()->save();
        } elseif ($token instanceof OauthTokenInterface && $token->isExpired() && $token->isRefreshable()) {
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

        return $this->getHttpClient()->execute($request);
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
            ->addRawHeader(
                $this->getToken(OauthToken::SCOPE_PAYMENT_INFO)->getAuthorizationString()
            )
            ->setResponseEntity(new ListChannelSetsResponse())
            ->build()
        ;

        return $this->executeRequest($request, OauthToken::SCOPE_PAYMENT_INFO);
    }

    /**
     * @param bool $staticBind
     * @return string
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    protected function getBaseEntrypoint($staticBind = false)
    {
        switch ($this->configuration->getApiMode()) {
            case ClientConfiguration::API_MODE_SANDBOX:
                $default = $staticBind ? static::URL_SANDBOX : self::URL_SANDBOX;
                $url = $this->configuration->getCustomSandboxUrl() ?: $default;
                break;
            case ClientConfiguration::API_MODE_LIVE:
            default:
                $default = $staticBind ? static::URL_LIVE : self::URL_LIVE;
                $url = $this->configuration->getCustomLiveUrl() ?: $default;
                break;
        }

        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        return $url;
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
     * @link https://docs.payever.org/shopsystems/api/getting-started/authentication Documentation
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
            ->setGrantType(OauthTokenInterface::GRAND_TYPE_OBTAIN_TOKEN);

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setRequestEntity($requestEntity)
            ->setResponseEntity(new AuthenticationResponse())
            ->build();

        return $this->getHttpClient()->execute($request);
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
            ->setRefreshToken($token->getRefreshToken());

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setRequestEntity($requestEntity)
            ->setResponseEntity(new AuthenticationResponse())
            ->build();

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @param Request $request
     * @param string $scope
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     * @throws \Exception
     */
    protected function executeRequest($request, $scope = OauthToken::SCOPE_PAYMENT_ACTIONS)
    {
        try {
            return $this->getHttpClient()->execute($request);
        } catch (\Exception $exception) {
            if ($exception->getCode() === self::FORBIDDEN_ERROR_CODE) {
                $this->getTokens()->clear()->save();

                $newToken = $this->getToken($scope)->getAuthorizationString();
                $pieces = explode(':', $newToken, 2);
                $request->addHeader($pieces[0], $pieces[1]);

                return $this->getHttpClient()->execute($request);
            }

            throw $exception;
        }
    }

    /**
     * Returns URL for Authentication path
     *
     * @return string
     */
    protected function getAuthenticationURL()
    {
        return $this->getBaseEntrypoint() . self::SUB_URL_AUTH;
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
        return $this->getBaseEntrypoint() . sprintf(self::SUB_URL_LIST_CHANNEL_SETS, $businessUuid);
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
        return $this->getBaseEntrypoint() . self::SUB_URL_CURRENCY . (empty($lang) ? '' : '?_locale=' . $lang);
    }
}
