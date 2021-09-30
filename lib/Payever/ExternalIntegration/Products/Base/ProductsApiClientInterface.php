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

use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

interface ProductsApiClientInterface
{
    /**
     * Inform payever about product created
     *
     * @param ProductRequestEntity $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function createProduct(ProductRequestEntity $entity);

    /**
     * Inform payever about product updated
     *
     * @param ProductRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     * @throws \Exception
     */
    public function updateProduct(ProductRequestEntity $entity);

    /**
     * @param ProductRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     * @throws \Exception
     */
    public function createOrUpdateProduct(ProductRequestEntity $entity);

    /**
     * Inform payever about product being removed
     *
     * @param ProductRemovedRequestEntity $entity
     *
     * @return \Payever\ExternalIntegration\Core\Http\Response
     * @throws \Exception
     */
    public function removeProduct(ProductRemovedRequestEntity $entity);

    /**
     * Batch export products to payever
     *
     * @param ProductsIteratorInterface $productsIterator
     * @param string $externalId
     *
     * @return int - Number of successfully exported records
     * @throws \Exception
     */
    public function exportProducts(ProductsIteratorInterface $productsIterator, $externalId);
}
