<?php
/**
 * This class represents List Channel Sets ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\ListChannelSetsResultEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents List Channel Sets ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class ListChannelSetsResponse extends ResponseEntity
{
    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return array(
            'call',
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
            $this->result[] = new ListChannelSetsResultEntity($item);
        }
    }
}
