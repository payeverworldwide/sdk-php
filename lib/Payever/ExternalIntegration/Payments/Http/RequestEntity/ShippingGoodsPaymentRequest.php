<?php
/**
 * This class represents Shipping Goods Payment RequestInterface Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * This class represents Shipping Goods Payment RequestInterface Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string    getCustomerId()
 * @method string    getInvoiceId()
 * @method \DateTime getInvoiceDate()
 * @method self      setCustomerId(string $id)
 * @method self      setInvoiceId(string $id)
 */
class ShippingGoodsPaymentRequest extends RequestEntity
{
    /** @var string $customerId */
    protected $customerId;

    /** @var string $invoiceId */
    protected $invoiceId;

    /** @var \DateTime $invoiceDate */
    protected $invoiceDate;

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            (!$this->invoiceDate || $this->invoiceDate instanceof \DateTime)
        ;
    }

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
