<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Helper\StringHelper;

/**
 * This class represents Dynamic Call Entity
 * @SuppressWarnings(PHPMD.StaticAccess)
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
