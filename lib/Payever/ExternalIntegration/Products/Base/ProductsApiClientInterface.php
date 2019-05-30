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

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface ProductsApiClientInterface
{
    /**
     * Inform payever about product created
     *
     * @param ProductRequestEntity $entity
     *
     * @return mixed
     */
    public function createProduct(ProductRequestEntity $entity);

    /**
     * Inform payever about product updated
     *
     * @param ProductRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     */
    public function updateProduct(ProductRequestEntity $entity);

    /**
     * Inform payever about product being removed
     *
     * @param ProductRemovedRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     */
    public function removeProduct(ProductRemovedRequestEntity $entity);

    /**
     * Batch export products to payever
     *
     * @param ProductsIteratorInterface $productsIterator
     * @param string $externalId
     *
     * @return int - Number of successfully exported records
     */
    public function exportProducts(ProductsIteratorInterface $productsIterator, $externalId);
}
