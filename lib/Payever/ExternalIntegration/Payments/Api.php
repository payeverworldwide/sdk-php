<?php
/**
 * Class represents Payever Payments API Connector
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Payments;

use Payever\ExternalIntegration\Core\Base\AbstractClient;
use Payever\ExternalIntegration\Core\Base\IToken;
use Payever\ExternalIntegration\Core\Http\CurlClient;
use Payever\ExternalIntegration\Core\Authorization\Token;
use Payever\ExternalIntegration\Core\Authorization\TokenList;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Payments\Base\IApi;
use Payever\ExternalIntegration\Payments\Base\IConfiguration;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\AuthenticationRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\AuthorizePaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\CreatePaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\ListPaymentsRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\RefundPaymentRequest;
use Payever\ExternalIntegration\Payments\Http\RequestEntity\ShippingGoodsPaymentRequest;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\AuthenticationResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\AuthorizePaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\CancelPaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\CollectPaymentsResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\CreatePaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetCurrenciesResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\GetTransactionResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\LatePaymentsResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListChannelSetsResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentOptionsResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ListPaymentsResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\RefundPaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\RemindPaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\RetrieveApiCallResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\RetrievePaymentResponse;
use Payever\ExternalIntegration\Payments\Http\ResponseEntity\ShippingGoodsPaymentResponse;

/**
 * Class represents Payever Payments API Connector
 *
 * PHP version 5.4
 *
 * @category  Payments
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
abstract class Api implements IApi
{
    const URL_LIVE    = 'https://mein.payever.de/';
    const URL_SANDBOX = 'https://sandbox.payever.de/';

    const SUB_URL_AUTH                   = 'oauth/v2/token';
    const SUB_URL_CREATE_PAYMENT         = 'api/payment';
    const SUB_URL_RETRIEVE_PAYMENT       = 'api/payment/%s';
    const SUB_URL_LIST_PAYMENTS          = 'api/payment';
    const SUB_URL_REFUND_PAYMENT         = 'api/payment/refund/%s';
    const SUB_URL_AUTHORIZE_PAYMENT      = 'api/payment/authorize/%s';
    const SUB_URL_REMIND_PAYMENT         = 'api/payment/remind/%s';
    const SUB_URL_COLLECT_PAYMENTS       = 'api/payment/collect/%s';
    const SUB_URL_LATE_PAYMENTS          = 'api/payment/late-payment/%s';
    const SUB_URL_SHIPPING_GOODS_PAYMENT = 'api/payment/shipping-goods/%s';
    const SUB_URL_CANCEL_PAYMENT         = 'api/payment/cancel/%s';
    const SUB_URL_RETRIEVE_API_CALL      = 'api/%s';
    const SUB_URL_LIST_PAYMENT_OPTIONS   = 'api/shop/%s/payment-options/%s';
    const SUB_URL_LIST_CHANNEL_SETS      = 'api/shop/%s/channel-sets';
    const SUB_URL_TRANSACTION            = 'api/rest/v1/transactions/%s';
    const SUB_URL_CURRENCY               = 'api/rest/v1/currency';

    const GRAND_TYPE_OBTAIN_TOKEN  = 'http://www.payever.de/api/payment';
    const GRAND_TYPE_REFRESH_TOKEN = 'refresh_token';

    const ERROR_WRONG_CLIENT_DATA  = 'Configuration Error';
    const ERROR_EMPTY_ACCESS_TOKEN = 'Empty Access Token';

    private static $instance;

    /**
     * Stores oAuth Authentication Tokens
     *
     * @var TokenList $tokens
     */
    protected $tokens;

    /**
     * Stores API Configuration
     *
     * @var IConfiguration $configuration
     */
    protected $configuration;

    /**
     * Stores current Client
     *
     * @var AbstractClient $client
     */
    protected $client;

    protected $debugData = array();

    /**
     * Payever Payments API Instance constructor
     *
     * @throws \Exception
     */
    protected function __construct()
    {
        $this->loadConfiguration()->loadTokens();
    }

    /**
     * Prevents class cloning
     */
    private function __clone()
    {
    }

    /**
     * Prevents class unserialization
     */
    private function __wakeup()
    {
    }

    /**
     * {@inheritdoc}
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Loads payever API configuration
     * This method must load at least Client ID and Client Secret
     *
     * @return $this
     */
    abstract protected function loadConfiguration();

    /**
     * Loads Tokens
     *
     * @return $this
     */
    abstract protected function loadTokens();

    /**
     * Returns Authentication Token
     *
     * @param string $scope Token scope
     *
     * @return IToken|object
     *
     * @throws \Exception
     */
    public function getToken($scope = Token::SCOPE_PAYMENT_ACTIONS)
    {
        $key = md5($this->getConfiguration()->getHash() . $scope);

        /** @var IToken $token */
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

        return $token;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function obtainTokenRequest($scope)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        if (!in_array($scope, Token::getScopes())) {
            throw new \Exception('Scope provided is not valid');
        }

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setParams(
                array(
                    'grant_type'    => self::GRAND_TYPE_OBTAIN_TOKEN,
                    'scope'         => $scope,
                    'client_id'     => $this->configuration->getClientId(),
                    'client_secret' => $this->configuration->getClientSecret(),
                )
            )
            ->setRequestEntity(new AuthenticationRequest())
            ->setResponseEntity(new AuthenticationResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function refreshTokenRequest($token)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getAuthenticationURL())
            ->setParams(
                array(
                    'grant_type'    => self::GRAND_TYPE_REFRESH_TOKEN,
                    'refresh_token' => $token->getRefreshToken(),
                    'scope'         => $token->getScope(),
                    'client_id'     => $this->configuration->getClientId(),
                    'client_secret' => $this->configuration->getClientSecret(),
                )
            )
            ->setRequestEntity(new AuthenticationRequest())
            ->setResponseEntity(new AuthenticationResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function createPaymentRequest($orderData)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getCreatePaymentURL())
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_CREATE_PAYMENT)->getAuthorizationString(),
                )
            )
            ->setParams($orderData)
            ->setRequestEntity(new CreatePaymentRequest())
            ->setResponseEntity(new CreatePaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function retrievePaymentRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::get($this->getRetrievePaymentURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_INFO)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new RetrievePaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function listPaymentsRequest($method = null, $date = null, $currency = null, $status = null, $limit = 10)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::get($this->getListPaymentsURL())
            ->setParams(
                array(
                    'limit'        => $limit,
                    'access_token' => $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAccessToken(),
                    'payment_type' => $method,
                    'currency'     => $currency,
                    'state'        => $status,
                    'date'         => $date instanceof \DateTime ? $date->format(DATE_ATOM) : null,
                )
            )
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setRequestEntity(new ListPaymentsRequest())
            ->setResponseEntity(new ListPaymentsResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function refundPaymentRequest($paymentId, $amount)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getRefundPaymentURL($paymentId))
            ->setParams(
                array(
                    'amount' => $amount,
                )
            )
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setRequestEntity(new RefundPaymentRequest())
            ->setResponseEntity(new RefundPaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function authorizePaymentRequest($paymentId, $data = array())
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getAuthorizePaymentURL($paymentId))
            ->setParams(
                array(
                    'customer_id'  => isset($data['customer_id'])  ? $data['customer_id']  : null,
                    'invoice_id'   => isset($data['invoice_id'])   ? $data['invoice_id']   : null,
                    'invoice_date' => isset($data['invoice_date']) ? $data['invoice_date'] : null,
                )
            )
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setRequestEntity(new AuthorizePaymentRequest())
            ->setResponseEntity(new AuthorizePaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated This request is only available for Santa DE Invoice and not used anywhere
     *
     * @throws \Exception
     */
    public function remindPaymentRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getRemindPaymentURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new RemindPaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated This request is only available for Santa DE Invoice and not used anywhere
     *
     * @throws \Exception
     */
    public function collectPaymentsRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getCollectPaymentsURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new CollectPaymentsResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated This request is only available for Santa DE Invoice and not used anywhere
     *
     * @throws \Exception
     */
    public function latePaymentsRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getLatePaymentsURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new LatePaymentsResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function shippingGoodsPaymentRequest($paymentId, $data = array())
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getShippingGoodsPaymentURL($paymentId))
            ->setParams(
                array(
                    'customer_id'  => isset($data['customer_id'])  ? $data['customer_id']  : null,
                    'invoice_id'   => isset($data['invoice_id'])   ? $data['invoice_id']   : null,
                    'invoice_date' => isset($data['invoice_date']) ? $data['invoice_date'] : null,
                )
            )
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setRequestEntity(new ShippingGoodsPaymentRequest())
            ->setResponseEntity(new ShippingGoodsPaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function cancelPaymentRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::post($this->getCancelPaymentURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new CancelPaymentResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function retrieveApiCallRequest($callId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::get($this->getRetrieveApiCallURL($callId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new RetrieveApiCallResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function listPaymentOptionsRequest($slug = '', $channel = '', $params = '')
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $slug = $slug ?: $this->getConfiguration()->getSlug();
        $channel = $channel ?: $this->getConfiguration()->getChannelSet();

        $request = RequestBuilder::get($this->getListPaymentOptionsURL($slug, $channel, $params))
            ->setResponseEntity(new ListPaymentOptionsResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function listChannelSetsRequest($slug)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::get($this->getListChannelSetsURL($slug))
            ->setResponseEntity(new ListChannelSetsResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
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

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function getTransactionRequest($paymentId)
    {
        if (!$this->isLoaded()) {
            throw new \Exception('Payever Core Credentials are not set!');
        }

        $request = RequestBuilder::get($this->getTransactionURL($paymentId))
            ->setHeaders(
                array(
                    $this->getToken(Token::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString(),
                )
            )
            ->setResponseEntity(new GetTransactionResponse())
            ->build()
        ;

        $response = $this->getClient()->execute($request);

        return $response;
    }

    /**
     * Returns Base URL to payever Payments API
     *
     * @return string
     */
    protected function getBaseURL()
    {
        switch ($this->configuration->getApiMode()) {
            case Configuration::MODE_SANDBOX:
                $url = $this->configuration->getSandboxUrl() ?: self::URL_SANDBOX;
                break;
            case Configuration::MODE_LIVE:
            default:
                $url = self::URL_LIVE;
                break;
        }

        if (substr($url, -1) != '/') {
            $url .= '/';
        }

        return $url;
    }

    /**
     * Returns URL for Authentication path
     *
     * @return string
     */
    protected function getAuthenticationURL()
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_AUTH);
    }

    /**
     * Returns URL for Create Payment path
     *
     * @return string
     */
    protected function getCreatePaymentURL()
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_CREATE_PAYMENT);
    }

    /**
     * Returns URL for Retrieve Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getRetrievePaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_RETRIEVE_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for List Payments path
     *
     * @return string
     */
    protected function getListPaymentsURL()
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_LIST_PAYMENTS);
    }

    /**
     * Returns URL for Refund Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getRefundPaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_REFUND_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for Authorize Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getAuthorizePaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_AUTHORIZE_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for Remind Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getRemindPaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_REMIND_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for Collect Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getCollectPaymentsURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_COLLECT_PAYMENTS, $paymentId);
    }

    /**
     * Returns URL for Late Payments path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getLatePaymentsURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_LATE_PAYMENTS, $paymentId);
    }

    /**
     * Returns URL for Shipping Goods Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getShippingGoodsPaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_SHIPPING_GOODS_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for Cancel Payment path
     *
     * @param string $paymentId
     *
     * @return string
     */
    protected function getCancelPaymentURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_CANCEL_PAYMENT, $paymentId);
    }

    /**
     * Returns URL for Retrieve API Call path
     *
     * @param string $callId
     *
     * @return string
     */
    protected function getRetrieveApiCallURL($callId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_RETRIEVE_API_CALL, $callId);
    }

    /**
     * Returns URL for Available Payment Options path
     *
     * @param string $slug
     * @param string $channel
     * @param string $params
     *
     * @return string
     */
    protected function getListPaymentOptionsURL($slug, $channel, $params = '')
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_LIST_PAYMENT_OPTIONS, $slug, $channel)
            . (empty($params) ? '' : '?' . http_build_query($params));
    }

    /**
     * Returns URL for Available Channel Sets path
     *
     * @param string $slug
     *
     * @return string
     */
    protected function getListChannelSetsURL($slug)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_LIST_CHANNEL_SETS, $slug);
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
        return $this->getBaseURL() . sprintf(self::SUB_URL_CURRENCY) . (empty($lang) ? '' : '?_locale=' . $lang);
    }

    /**
     * Returns URL to Transaction path
     *
     * @param int $paymentId
     *
     * @return string
     */
    protected function getTransactionURL($paymentId)
    {
        return $this->getBaseURL() . sprintf(self::SUB_URL_TRANSACTION, $paymentId);
    }

    /**
     * Returns Debug data array
     *
     * @return array
     */
    public function getDebugData()
    {
        return $this->debugData;
    }

    /**
     * Adds data to the debug array if debug mode is enabled
     *
     * @param mixed $data
     *
     * @return $this
     */
    protected function debug($data)
    {
        if ($this->configuration->getDebugMode()) {
            $this->debugData[] = $data;
        }

        return $this;
    }

    /**
     * Returns current configuration
     *
     * @return IConfiguration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Returns current Token list
     *
     * @return TokenList
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Overrides configuration
     *
     * @param IConfiguration $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        $this->getTokens()->clear()->save();
    }

    /**
     * Returns available Grand Types
     *
     * @return array
     */
    public static function getGrandTypes()
    {
        return array(
            self::GRAND_TYPE_REFRESH_TOKEN,
            self::GRAND_TYPE_OBTAIN_TOKEN,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getClient()
    {
        if ($this->client === null) {
            $this->client = new CurlClient();
        }

        return $this->client;
    }

    /**
     * {@inheritdoc}
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Returns if Configuration is loaded successfully
     *
     * @return bool
     */
    public function isLoaded()
    {
        return
            $this->configuration &&
            $this->configuration->getClientId() &&
            $this->configuration->getClientSecret() &&
            $this->configuration->getSlug()
        ;
    }
}
