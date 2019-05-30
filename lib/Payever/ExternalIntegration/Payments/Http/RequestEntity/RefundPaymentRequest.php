<?php
/**
 * This class represents Refund Payment RequestInterface Entity
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
 * This class represents Refund Payment RequestInterface Entity
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
 * @method float getAmount()
 * @method self  setAmount(float $amount)
 */
class RefundPaymentRequest extends RequestEntity
{
    /** @var float $amount */
    protected $amount;

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            (!$this->amount || is_numeric($this->amount))
        ;
    }
}
