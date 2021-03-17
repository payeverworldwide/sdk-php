<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

/**
 * This class represents Error Entity
 */
class ErrorEntity extends DynamicEntity
{
    /**
     * @param array|string|null $data
     */
    public function __construct($data = null)
    {
        if (!is_array($data)) {
            $data = ['message' => $data];
        }

        parent::__construct($data);
    }
}
