<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Base
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Products\Base;

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

/**
 * Interface ProductsIteratorInterface
 *
 * Implement this interface in order to batch export products to payever
 * @see ProductsApiClientInterface::exportProducts()
 */
interface ProductsIteratorInterface extends \Iterator
{
    /**
     * @return ProductRequestEntity
     */
    #[\ReturnTypeWillChange]
    public function current();
}
