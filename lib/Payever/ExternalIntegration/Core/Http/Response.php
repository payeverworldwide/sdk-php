<?php
/**
 * This class represents Response
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

use Payever\ExternalIntegration\Core\Base\IResponse;
use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents Response
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
class Response implements IResponse
{
    /** @var RequestEntity $requestEntity */
    protected $requestEntity;

    /** @var ResponseEntity $responseEntity */
    protected $responseEntity;

    /** @var string $data */
    protected $data;

    /**
     * Response constructor
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
            ->load(StringHelper::jsonDecode($this->data))
        ;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestEntity($requestEntity)
    {
        $this->requestEntity = $requestEntity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setResponseEntity($responseEntity)
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
     * Returns if Response is successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getResponseEntity()->isSuccessful();
    }

    /**
     * Returns if Response is failed
     *
     * @return bool
     */
    public function isFailed()
    {
        return $this->getResponseEntity()->isFailed();
    }

    /**
     * Returns data from Response
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
