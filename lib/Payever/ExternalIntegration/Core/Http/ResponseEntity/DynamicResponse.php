<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Helper\StringHelper;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * This class represents Dynamic ResponseInterface Entity
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class DynamicResponse extends ResponseEntity
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
