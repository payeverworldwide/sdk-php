<?php
/**
 * This class represents Response Entity
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

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\CallEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ResultEntity;

/**
 * This class represents Response Entity
 *
 * PHP version 5.4
 *
 * @category  Http
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/developer/api-documentation/ Documentation
 *
 * @method CallEntity   getCall()
 * @method string       getError()
 * @method string       getErrorDescription()
 * @method ResultEntity getResult()
 */
class ResponseEntity extends MessageEntity
{
    /** @var CallEntity $call */
    protected $call;

    /** @var string $error */
    protected $error;

    /** @var string $errorDescription */
    protected $errorDescription;

    /** @var ResultEntity $result */
    protected $result;

    /**
     * Returns if Entity is successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return empty($this->error);
    }

    /**
     * Returns if Entity is failed
     *
     * @return bool
     */
    public function isFailed()
    {
        return !$this->isSuccessful();
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            (!$this->call   || ($this->call   instanceof CallEntity   && $this->call->isValid())) &&
            (!$this->result || ($this->result instanceof ResultEntity && $this->result->isValid()) || is_array($this->result))
        ;
    }

    /**
     * Sets Call Entity
     *
     * @param array $call
     */
    public function setCall($call)
    {
        /**
         * @TODO CallEntity is a dependency from an external package Payments, reconsider it here
         */
        $this->call = new CallEntity($call);
    }

    /**
     * Sets Error Property
     *
     * @param array|string $error
     */
    public function setError($error)
    {
        if (is_array($error)) {
            $error = json_encode($error);
        }

        $this->error = $error;
    }

    /**
     * Sets ErrorDescription Property
     *
     * @param array|string $errorDescription
     */
    public function setErrorDescription($errorDescription)
    {
        if (is_array($errorDescription)) {
            $errorDescription = json_encode($errorDescription);
        }

        $this->errorDescription = $errorDescription;
    }

    /**
     * Sets Result Entity
     *
     * @param array $result
     */
    public function setResult($result)
    {
        /**
         * @TODO ResultEntity is a dependency from an external package Payments, reconsider it here
         */
        $this->result = new ResultEntity($result);
    }
}
