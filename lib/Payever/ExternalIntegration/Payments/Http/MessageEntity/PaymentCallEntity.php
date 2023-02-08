<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;

/**
 * This class represents Payment Call Entity
 *
 * @method string    getPaymentId()
 * @method string    getCustomerId()
 * @method string    getInvoiceId()
 * @method \DateTime|false getInvoiceDate()
 * @method string    getType()
 * @method string    getMessage()
 * @method self      setPaymentId(string $paymentId)
 * @method self      setCustomerId(string $customerId)
 * @method self      setInvoiceId(string $invoiceId)
 * @method self      setType(string $type)
 * @method self      setMessage(string $message)
 */
class PaymentCallEntity extends CallEntity
{
    /** @var string $paymentId */
    protected $paymentId;

    /** @var string $customerId */
    protected $customerId;

    /** @var string $invoiceId */
    protected $invoiceId;

    /** @var \DateTime|bool $invoiceDate */
    protected $invoiceDate;

    /** @var string $type */
    protected $type;

    /** @var string $message */
    protected $message;

    /**
     * Sets Invoice Date
     *
     * @param string $invoiceDate
     * @return self
     */
    public function setInvoiceDate($invoiceDate)
    {
        if ($invoiceDate) {
            $this->invoiceDate = date_create($invoiceDate);
        }

        return $this;
    }
}
