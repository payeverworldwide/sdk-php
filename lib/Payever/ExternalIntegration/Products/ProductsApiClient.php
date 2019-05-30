<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Products;

use Payever\ExternalIntegration\Core\Base\OauthTokenInterface;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\DynamicResponse;
use Payever\ExternalIntegration\Products\Base\ProductsApiClientInterface;
use Payever\ExternalIntegration\Products\Base\ProductsIteratorInterface;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\ExternalIntegration\ThirdParty\ThirdPartyApiClient;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class ProductsApiClient extends ThirdPartyApiClient implements ProductsApiClientInterface
{
    const SUB_URL_PRODUCT = 'api/product/%s';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function createProduct(ProductRequestEntity $entity)
    {
        $this->configuration->assertLoaded();

        $url = $this->getProductUrl($entity->getExternalId());

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken(OauthTokenInterface::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function updateProduct(ProductRequestEntity $entity)
    {
        $this->configuration->assertLoaded();

        $url = $this->getProductUrl($entity->getExternalId());

        $request = RequestBuilder::patch($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken(OauthTokenInterface::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function removeProduct(ProductRemovedRequestEntity $entity)
    {
        $this->configuration->assertLoaded();

        $url = $this->getProductUrl($entity->getExternalId());

        $request = RequestBuilder::delete($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken(OauthTokenInterface::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setRequestEntity($entity)
            ->setResponseEntity(new DynamicResponse())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @inheritdoc
     */
    public function exportProducts(ProductsIteratorInterface $productsIterator, $externalId)
    {
        $this->configuration->assertLoaded();
        $successCount = 0;

        foreach ($productsIterator as $productRequestEntity) {
            try {
                $productRequestEntity->setExternalId($externalId);
                $this->createProduct($productRequestEntity);
                $successCount++;
            } catch (\Exception $exception) {
                $this->configuration->getLogger()
                    ->critical(
                        sprintf(
                            'Product SKU=%s failed to export: %s',
                            $productRequestEntity->getSku(),
                            $exception->getMessage()
                        )
                    );
            }
        }

        return $successCount;
    }

    /**
     * @param string $externalId
     * @return string
     */
    protected function getProductUrl($externalId)
    {
        return $this->getThirdPartyBaseUrl() . sprintf(static::SUB_URL_PRODUCT, $externalId);
    }
}
