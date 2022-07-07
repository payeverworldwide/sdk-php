<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * This class represents Refund Payment items RequestInterface Entity
 *
 * @method float getDeliveryFee()
 * @method self  setDeliveryFee(float $deliveryFee)
 * @method float getPaymentItems()
 * @method self  setPaymentItems(array $paymentItems)
 */
class RefundItemsPaymentRequest extends RequestEntity
{
    /** @var float $deliveryFee */
    protected $deliveryFee;

    /** @var PaymentItemEntity[] $paymentItems */
    protected $paymentItems;

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() && (!$this->paymentItems || is_array($this->paymentItems));
    }
}
