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
 * @method string getId()
 * @method string getBusinessUuid()
 * @method string getTitle()
 * @method string getSlug()
 * @method string setId(string $id)
 * @method self setBusinessUuid(string $businessUuid)
 * @method self setTitle(string $title)
 * @method self setSlug(string $slug)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class ProductCategoryEntity extends MessageEntity
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $businessUuid;

    /** @var string */
    protected $title;

    /** @var string */
    protected $slug;
}
