<?php
/**
 * This class represents Payment Call Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * This class represents Payment Call Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string    getPaymentId()
 * @method string    getCustomerId()
 * @method string    getInvoiceId()
 * @method \DateTime getInvoiceDate()
 * @method string    getType()
 * @method string    getMessage()
 * @method self      setPaymentId()
 * @method self      setCustomerId()
 * @method self      setInvoiceId()
 * @method self      setType()
 * @method self      setMessage()
 */
class PaymentCallEntity extends CallEntity
{
    /** @var string $paymentId */
    protected $paymentId;

    /** @var string $customerId */
    protected $customerId;

    /** @var string $invoiceId */
    protected $invoiceId;

    /** @var \DateTime $invoiceDate */
    protected $invoiceDate;

    /** @var string $type */
    protected $type;

    /** @var string $message */
    protected $message;

    /**
     * Sets Invoice Date
     *
     * @param string $invoiceDate
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = date_create($invoiceDate);
    }
}
