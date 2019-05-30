<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Notification;

/**
 * Utility class for unified notifications result representation
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class NotificationResult
{
    /** @var string */
    protected $orderId;

    /** @var bool */
    protected $orderHasBeenCreated = false;

    /** @var string */
    protected $previousOrderStatus;

    /** @var string */
    protected $currentOrderStatus;

    /** @var string[] */
    protected $messages = array();

    /** @var string[] */
    protected $errors = array();

    /**
     * @param string $orderId
     *
     * @return static
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return static
     */
    public function orderHasBeenCreated()
    {
        $this->orderHasBeenCreated = true;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return static
     */
    public function setPreviousOrderStatus($status)
    {
        $this->previousOrderStatus = $status;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return static
     */
    public function setCurrentOrderStatus($status)
    {
        $this->currentOrderStatus = $status;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return static
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * @param string $error
     *
     * @return static
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @param \Exception $exception
     *
     * @return static
     */
    public function addException(\Exception $exception)
    {
        $this->addError(sprintf('%s: %s', $exception->getCode(), $exception->getMessage()));

        return $this;
    }

    /**
     * @return bool
     */
    public function isFailed()
    {
        return !empty($this->errors);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $pieces = array();

        if ($this->isFailed()) {
            $pieces[] = 'FAILED';
        }

        if ($this->errors) {
            $pieces[] = sprintf('[errors=%s]', implode(';', $this->$this->errors));
        }

        if ($this->orderHasBeenCreated) {
            $pieces[] = '[orderCreated]';
        }

        if ($this->orderId) {
            $pieces[] = sprintf('[orderId=%s]', $this->orderId);
        }

        if ($this->previousOrderStatus) {
            $pieces[] = sprintf('[previousStatus=%s]', $this->previousOrderStatus);
        }

        if ($this->currentOrderStatus) {
            $pieces[] = sprintf('[currentStatus=%s]', $this->currentOrderStatus);
        }

        if ($this->messages) {
            $pieces[] = sprintf('[messages=%s]', implode(';', $this->messages));
        }

        return sprintf('Result: %s', implode(' ', $pieces));
    }
}
