<?php
/**
 * This class represents Dynamic Call Entity
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

use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents Dynamic Call Entity
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
class DynamicEntity extends CallEntity
{
    /**
     * {@inheritdoc}
     */
    public function load($data)
    {
        foreach ($data as $key => $value) {
            $property = StringHelper::camelize($key);

            $this->{$property} = $value;
        }

        return $this;
    }
}
