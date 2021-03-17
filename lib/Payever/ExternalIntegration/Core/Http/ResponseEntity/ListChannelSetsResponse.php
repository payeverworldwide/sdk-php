<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\ListChannelSetsResultEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents List Channel Sets ResponseInterface Entity
 */
class ListChannelSetsResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return [
            'call',
            'result',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setResult($result)
    {
        $this->result = [];
        foreach ($result as $item) {
            $this->result[] = new ListChannelSetsResultEntity($item);
        }
    }
}
