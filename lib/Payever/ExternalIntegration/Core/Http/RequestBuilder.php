<?php
/**
 * This class represents Request Builder
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */

namespace Payever\ExternalIntegration\Core\Http;

/**
 * This class represents Request Builder
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 */
class RequestBuilder
{
    /** @var null|string $url */
    protected $url;

    /** @var string $method */
    protected $method = Request::METHOD_GET;

    /** @var array $headers */
    protected $headers = array();

    /** @var array $params */
    protected $params = array();

    /** @var string $protocolVersion */
    protected $protocolVersion = '1.1';

    /** @var RequestEntity $requestEntity */
    protected $requestEntity;

    /** @var ResponseEntity $responseEntity */
    protected $responseEntity;

    /**
     * HttpRequestBuilder constructor
     *
     * @param string $url
     * @param string $method
     */
    public function __construct($url = null, $method = Request::METHOD_GET)
    {
        $this->method = $method;
        $this->url = $url;
        $this->requestEntity = new RequestEntity();
        $this->responseEntity = new ResponseEntity();
    }

    /**
     * Instantiates HttpRequestBuilder with GET method set
     *
     * @param string|null $url
     *
     * @return self
     */
    public static function get($url = null)
    {
        return new static($url, Request::METHOD_GET);
    }

    /**
     * Instantiates HttpRequestBuilder with POST method set
     *
     * @param string|null $url
     *
     * @return self
     */
    public static function post($url = null)
    {
        return new static($url, Request::METHOD_POST);
    }

    /**
     * Builds Request object
     *
     * @return Request
     */
    public function build()
    {
        $request = new Request();

        $request
            ->setUrl($this->getUrl())
            ->setMethod($this->getMethod())
            ->setHeaders($this->getHeaders())
            ->setParams($this->getParams())
            ->setProtocolVersion($this->getProtocolVersion())
            ->setRequestEntity($this->getRequestEntity())
            ->setResponseEntity($this->getResponseEntity())
            ;

        $request->getRequestEntity()->load($request->getParams());

        return $request;
    }

    /**
     * Adds Header to Headers array
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return self
     */
    public function addHeader($name, $value = null)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Replaces Headers with given array
     *
     * @param array $headers
     *
     * @return self
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Returns Header value from Headers array with given name
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function getHeader($name)
    {
        if ($this->containsHeader($name)) {
            return $this->headers[$name];
        }

        return false;
    }

    /**
     * Returns Headers array
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Cleans Headers array
     *
     * @return self
     */
    public function cleanHeaders()
    {
        $this->headers = array();

        return $this;
    }

    /**
     * Returns if the Header with given name is set
     *
     * @param string $name
     *
     * @return bool
     */
    public function containsHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * Removes Header with given name from Headers array
     *
     * @param string $name
     *
     * @return self
     */
    public function removeHeader($name)
    {
        unset($this->headers[$name]);

        return $this;
    }

    /**
     * Adds Param to Params array
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return self
     */
    public function addParam($name, $value = null)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * Replaces Params with given array
     *
     * @param array $params
     *
     * @return self
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Returns Param value from Params array with given name
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function getParam($name)
    {
        if ($this->containsParam($name)) {
            return $this->params[$name];
        }

        return false;
    }

    /**
     * Returns Params array
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Cleans Params array
     *
     * @return self
     */
    public function cleanParams()
    {
        $this->params = array();

        return $this;
    }

    /**
     * Returns if the Param with given name is set
     *
     * @param string $name
     *
     * @return bool
     */
    public function containsParam($name)
    {
        return isset($this->params[$name]);
    }

    /**
     * Removes Param with given name from Params array
     *
     * @param string $name
     *
     * @return self
     */
    public function removeParam($name)
    {
        unset($this->params[$name]);

        return $this;
    }

    /**
     * Sets URL
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets Http Method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method = Request::METHOD_GET)
    {
        if (in_array($method, self::getMethods())) {
            $this->method = $method;
        }

        return $this;
    }

    /**
     * Returns Http method used
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Returns available Http Methods
     *
     * @return array
     */
    public static function getMethods()
    {
        return Request::getMethods();
    }
    
    /**
     * Sets Request Entity
     *
     * @param RequestEntity $requestEntity
     *
     * @return self
     */
    public function setRequestEntity($requestEntity)
    {
        $this->requestEntity = $requestEntity;

        return $this;
    }

    /**
     * Sets Response Entity
     *
     * @param ResponseEntity $responseEntity
     *
     * @return self
     */
    public function setResponseEntity($responseEntity)
    {
        $this->responseEntity = $responseEntity;

        return $this;
    }

    /**
     * Returns Request Entity used
     *
     * @return RequestEntity
     */
    public function getRequestEntity()
    {
        return $this->requestEntity;
    }

    /**
     * Returns Response Entity used
     *
     * @return ResponseEntity
     */
    public function getResponseEntity()
    {
        return $this->responseEntity;
    }

    /**
     * Get Protocol version
     *
     * @return string
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * Set Protocol Version
     *
     * @param string $protocolVersion
     *
     * @return self
     */
    public function setProtocolVersion($protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;

        return $this;
    }
}
