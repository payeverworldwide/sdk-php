<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * @method string getName()
 * @method string getValue()
 * @method self setName(string $name)
 * @method self setValue(string $value)
 */
class ProductVariantOptionEntity extends MessageEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $value;

    /**
     * @return string
     */
    public function getUnderscoreName()
    {
        return strtolower(str_replace(' ', '_', $this->name));
    }
}
