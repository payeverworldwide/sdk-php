<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Products\Base;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

/**
 * Interface ProductsIteratorInterface
 *
 * Implement this interface in order to batch export products to payever
 * @see ProductsApiClientInterface::exportProducts()
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface ProductsIteratorInterface extends \Iterator
{
    /**
     * @return ProductRequestEntity
     */
    public function current();
}
