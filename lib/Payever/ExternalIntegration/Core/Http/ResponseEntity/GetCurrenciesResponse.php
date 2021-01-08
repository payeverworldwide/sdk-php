<?php
/**
 * This class represents Get Currencies ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\GetCurrenciesResultEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents Get Currencies ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class GetCurrenciesResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        if (!is_array($data) || !isset($data['result'])) {
            $data = array('result' => $data);
        }

        return parent::load($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return array(
            'result',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setResult($result)
    {
        $this->result = array();

        foreach ($result as $item) {
            $entity = new GetCurrenciesResultEntity($item);
            $this->result[$entity->getCode()] = $entity;
        }
    }
}
