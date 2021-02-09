<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * This class represents List Payment Options Result Entity
 *
 * @method bool                             getAcceptFee()
 */
class ListPaymentOptionsResultEntity extends AbstractPaymentOptionEntity
{
    /** @var bool $acceptFee */
    protected $acceptFee;

    /**
     * Sets Accept Fee
     *
     * @param bool $acceptFee
     */
    public function setAcceptFee($acceptFee)
    {
        $this->acceptFee = filter_var($acceptFee, FILTER_VALIDATE_BOOLEAN);
    }
}
