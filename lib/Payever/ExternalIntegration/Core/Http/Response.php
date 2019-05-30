<?php
/**
 * This class represents ResponseInterface
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

use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents ResponseInterface
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
class Response implements ResponseInterface
{
    /** @var RequestEntity $requestEntity */
    protected $requestEntity;

    /** @var ResponseEntity $responseEntity */
    protected $responseEntity;

    /** @var string $data */
    protected $data;

    /**
     * ResponseInterface constructor
     */
    public function __construct()
    {
        $this->responseEntity = new ResponseEntity();
    }

    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        $this->data = $data;

        $this
            ->getResponseEntity()
            ->load($data ? StringHelper::jsonDecode($this->data) : array())
        ;

        return $this;
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
     * Returns if ResponseInterface is successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getResponseEntity()->isSuccessful();
    }

    /**
     * Returns if ResponseInterface is failed
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->getResponseEntity()->isFailed();
    }

    /**
     * Returns data from ResponseInterface
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
