<?php

/**
 * PHP version 5.4 and 7
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
 * Class ProductCategoryEntity
 *
 * @method string getTitle()
 * @method string getSlug()
 * @method self setTitle(string $title)
 * @method self setSlug(string $slug)
 */
class ProductCategoryEntity extends MessageEntity
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $slug;
}
