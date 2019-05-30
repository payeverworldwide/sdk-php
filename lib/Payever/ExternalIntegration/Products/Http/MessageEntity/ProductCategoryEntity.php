<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * Class ProductCategoryEntity
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
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
