<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Logger
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Logger;

/**
 * Class NullLogger
 *
 * All records are thrown away. Default logger if none explicitly provided.
 */
class NullLogger extends \Psr\Log\AbstractLogger
{
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = [])
    {
    }
}
