<?php
/**
 * This class represents Error Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

/**
 * This class represents Error Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class ErrorEntity extends DynamicEntity
{
    public function __construct($data = null)
    {
        if (!is_array($data)) {
            $data = array('message' => $data);
        }

        parent::__construct($data);
    }
}
