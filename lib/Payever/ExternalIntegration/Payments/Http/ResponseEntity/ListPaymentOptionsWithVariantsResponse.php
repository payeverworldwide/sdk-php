<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsCallEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsVariantsResultEntity;

/**
 * This class represents List Payment Options ResponseInterface Entity
 *
 * @method array|ListPaymentOptionsVariantsResultEntity[] getResult()
 */
class ListPaymentOptionsWithVariantsResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function setCall($call)
    {
        $this->call = new ListPaymentOptionsCallEntity($call);
    }

    /**
     * {@inheritdoc}
     */
    public function setResult($result)
    {
        $this->result = [];

        foreach ($result as $item) {
            $this->result[] = new ListPaymentOptionsVariantsResultEntity($item);
        }
    }
}
