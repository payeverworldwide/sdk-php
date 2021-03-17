<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http;

use Payever\ExternalIntegration\Core\Base\RequestInterface;

/**
 * This class represents RequestInterface
 */
class Request implements RequestInterface
{
    const METHOD_GET     = 'GET';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_PATCH   = 'PATCH';
    const METHOD_DELETE  = 'DELETE';

    /** @var null|string $url */
    protected $url;

    /** @var string $method */
    protected $method = self::METHOD_GET;

    /** @var array $headers */
    protected $headers = [];

    /** @var array $params */
    protected $params = [];

    /** @var string $protocolVersion */
    protected $protocolVersion = '1.1';

    /** @var RequestEntity $requestEntity */
    protected $requestEntity;

    /** @var ResponseEntity $responseEntity */
    protected $responseEntity;

    /**
     * {@inheritdoc}
     */
    public function addHeader($name, $value = null)
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader($name)
    {
        if ($this->containsHeader($name)) {
            return $this->headers[$name];
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        $prettyHeaders = [];

        foreach ($this->headers as $name => $value) {
            $prettyHeaders[] = sprintf('%s: %s', $name, $value);
        }

        return $prettyHeaders;
    }

    /**
     * {@inheritdoc}
     */
    public function cleanHeaders()
    {
        $this->headers = [];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function containsHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeHeader($name)
    {
        unset($this->headers[$name]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addParam($name, $value = null)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getParam($name)
    {
        if ($this->containsParam($name)) {
            return $this->params[$name];
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * {@inheritdoc}
     */
    public function cleanParams()
    {
        $this->params = [];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function containsParam($name)
    {
        return isset($this->params[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeParam($name)
    {
        unset($this->params[$name]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function setMethod($method = self::METHOD_GET)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestEntity(RequestEntity $requestEntity)
    {
        $this->requestEntity = $requestEntity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setResponseEntity(ResponseEntity $responseEntity)
    {
        $this->responseEntity = $responseEntity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestEntity()
    {
        return $this->requestEntity;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseEntity()
    {
        return $this->responseEntity;
    }

    /**
     * {@inheritdoc}
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * {@inheritdoc}
     */
    public function setProtocolVersion($protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        return $this->getRequestEntity()->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public static function getMethods()
    {
        return [
            self::METHOD_GET,
            self::METHOD_POST,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = $this->getRequestEntity()->toArray();

        if (
            $this->getHeader('Content-Type') == 'application/x-www-form-urlencoded'
            || $this->getHeader('Content-Type') == 'application/json'
        ) {
            return $array;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = json_encode($value);
            }
        }

        return $array;
    }
}
