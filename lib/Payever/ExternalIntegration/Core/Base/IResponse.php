<?php
/**
 * Interface describes functions of Response
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
 * Interface describes functions of Response
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
interface IResponse
{
    /**
     * Loads response object
     *
     * @param array|string|object $params
     *
     * @return self
     */
    public function load($params);

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
}
