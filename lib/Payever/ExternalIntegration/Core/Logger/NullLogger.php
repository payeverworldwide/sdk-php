<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core\Logger;

/**
 * Class NullLogger
 *
 * All records are thrown away. Default logger if none explicitly provided.
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class NullLogger extends \Psr\Log\AbstractLogger
{
    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = array())
    {
    }
}
