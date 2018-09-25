<?php
/**
 * Interface describes functions of Request
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Base;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * Interface describes functions of Request
 *
 * PHP version 5.4
 *
 * @category  Base
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
interface IRequest
{
    /**
     * Adds Header to Headers array
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return self
     */
    public function addHeader($name, $value = null);

    /**
     * Replaces Headers with given array
     *
     * @param array $headers
     *
     * @return self
     */
    public function setHeaders($headers);

    /**
     * Returns Header value from Headers array with given name
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function getHeader($name);

    /**
     * Returns Headers array
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Cleans Headers array
     *
     * @return self
     */
    public function cleanHeaders();

    /**
     * Returns if the Header with given name is set
     *
     * @param string $name
     *
     * @return bool
     */
    public function containsHeader($name);

    /**
     * Removes Header with given name from Headers array
     *
     * @param string $name
     *
     * @return self
     */
    public function removeHeader($name);

    /**
     * Adds Param to Params array
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return self
     */
    public function addParam($name, $value = null);

    /**
     * Replaces Params with given array
     *
     * @param array $params
     *
     * @return self
     */
    public function setParams($params);

    /**
     * Returns Param value from Params array with given name
     *
     * @param string $name
     *
     * @return bool|string
     */
    public function getParam($name);

    /**
     * Returns Params array
     *
     * @return array
     */
    public function getParams();

    /**
     * Cleans Params array
     *
     * @return self
     */
    public function cleanParams();

    /**
     * Returns if the Param with given name is set
     *
     * @param string $name
     *
     * @return bool
     */
    public function containsParam($name);

    /**
     * Removes Param with given name from Params array
     *
     * @param string $name
     *
     * @return self
     */
    public function removeParam($name);

    /**
     * Sets URL
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Returns URL
     *
     * @return string
     */
    public function getUrl();

    /**
     * Sets Http Method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method);

    /**
     * Returns Http method used
     *
     * @return string
     */
    public function getMethod();

    /**
     * Sets Request Entity
     *
     * @param RequestEntity $requestEntity
     *
     * @return self
     */
    public function setRequestEntity($requestEntity);

    /**
     * Sets Response Entity
     *
     * @param ResponseEntity $responseEntity
     *
     * @return self
     */
    public function setResponseEntity($responseEntity);

    /**
     * Returns Request Entity used
     *
     * @return RequestEntity
     */
    public function getRequestEntity();

    /**
     * Returns Response Entity used
     *
     * @return ResponseEntity
     */
    public function getResponseEntity();

    /**
     * Get Protocol version
     *
     * @return string
     */
    public function getProtocolVersion();

    /**
     * Set Protocol Version
     *
     * @param string $protocolVersion
     *
     * @return self
     */
    public function setProtocolVersion($protocolVersion);

    /**
     * Returns available Http Methods
     *
     * @return array
     */
    public static function getMethods();

    /**
     * Validates instance
     *
     * @return bool
     */
    public function validate();

    /**
     * Returns params array
     *
     * @return array
     */
    public function toArray();
}
