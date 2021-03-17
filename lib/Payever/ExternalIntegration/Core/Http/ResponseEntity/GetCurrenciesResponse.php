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

use Payever\ExternalIntegration\Core\Http\MessageEntity\GetCurrenciesResultEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents Get Currencies ResponseInterface Entity
 */
class GetCurrenciesResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        if (!is_array($data) || !isset($data['result'])) {
            $data = ['result' => $data];
        }

        return parent::load($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return [
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
            $entity = new GetCurrenciesResultEntity($item);
            $this->result[$entity->getCode()] = $entity;
        }
    }
}
