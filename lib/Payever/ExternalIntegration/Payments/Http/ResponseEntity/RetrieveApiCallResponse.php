<?php
/**
 * This class represents Retrieve Api Call Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\DynamicEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents Retrieve Api Call Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class RetrieveApiCallResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        if (!is_array($data) || !isset($data['call'])) {
            $data = array('call' => $data);
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
