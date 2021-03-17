<?php

/**
 * PHP version 5.4 and 7
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

use Payever\ExternalIntegration\Core\Http\MessageEntity\DynamicEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents Retrieve Api Call Entity
 */
class RetrieveApiCallResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        if (!is_array($data) || !isset($data['call'])) {
            $data = ['call' => $data];
        }

        return parent::load($data);
    }

    /**
     * {@inheritdoc}
     */
    public function setCall($call)
    {
        $this->call = new DynamicEntity($call);
    }
}
