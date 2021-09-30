<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentCallEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ShippingGoodsPaymentResultEntity;

/**
 * This class represents Shipping Goods Payment ResponseInterface Entity
 */
class ShippingGoodsPaymentResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function setCall($call)
    {
        $this->call = new PaymentCallEntity($call);
    }

    /**
     * {@inheritdoc}
     */
    public function setResult($result)
    {
        $this->result = new ShippingGoodsPaymentResultEntity($result);
    }
}
