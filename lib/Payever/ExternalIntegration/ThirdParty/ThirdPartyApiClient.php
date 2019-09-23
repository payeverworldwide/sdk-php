<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty;

use Payever\ExternalIntegration\Core\Authorization\OauthToken;
use Payever\ExternalIntegration\Core\CommonApiClient;
use Payever\ExternalIntegration\Core\Http\RequestBuilder;
use Payever\ExternalIntegration\Core\Http\ResponseEntity\DynamicResponse;
use Payever\ExternalIntegration\ThirdParty\Base\ThirdPartyApiClientInterface;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;
use Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\BusinessResponseEntity;
use Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity;

/**
 * Class ThirdPartyApiClient
 *
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class ThirdPartyApiClient extends CommonApiClient implements ThirdPartyApiClientInterface
{
    const SUB_URL_BUSINESS_INFO = 'api/business/%s/plugins';
    const SUB_URL_SUBSCRIPTION = 'api/business/%s/plugins/subscription/%s';

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getBusinessRequest()
    {
        $this->configuration->assertLoaded();

        $request = RequestBuilder::get($this->getBusinessInfoUrl($this->configuration->getBusinessUuid()))
            ->addRawHeader(
                $this->getToken(OauthToken::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setResponseEntity(new BusinessResponseEntity())
            ->build()
        ;

        $response = $this->getHttpClient()->execute($request);

        return $response;
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function getSubscriptionStatus(SubscriptionRequestEntity $subscriptionRequestEntity)
    {
        $this->configuration->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequestEntity);

        $url = $this->getSubscriptionUrl($subscriptionRequestEntity);

        $request = RequestBuilder::get($url)
            ->addRawHeader(
                $this->getToken(OauthToken::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setResponseEntity(new SubscriptionResponseEntity())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function subscribe(SubscriptionRequestEntity $subscriptionRequestEntity)
    {
        $this->configuration->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequestEntity);

        $url = $this->getSubscriptionUrl($subscriptionRequestEntity);

        $request = RequestBuilder::post($url)
            ->contentTypeIsJson()
            ->addRawHeader(
                $this->getToken(OauthToken::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setRequestEntity($subscriptionRequestEntity)
            ->setResponseEntity(new SubscriptionResponseEntity())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function unsubscribe(SubscriptionRequestEntity $subscriptionRequestEntity)
    {
        $this->configuration->assertLoaded();

        $this->fillSubscriptionEntityFromConfiguration($subscriptionRequestEntity);

        $url = $this->getSubscriptionUrl($subscriptionRequestEntity);

        $request = RequestBuilder::delete($url)
            ->addRawHeader(
                $this->getToken(OauthToken::SCOPE_PAYMENT_ACTIONS)->getAuthorizationString()
            )
            ->setRequestEntity($subscriptionRequestEntity)
            ->setResponseEntity(new DynamicResponse())
            ->build()
        ;

        return $this->getHttpClient()->execute($request);
    }

    /**
     * @param SubscriptionRequestEntity $subscriptionRequestEntity
     *
     * @return string
     */
    protected function getSubscriptionUrl(SubscriptionRequestEntity $subscriptionRequestEntity)
    {
        return $this->getBaseUrl()
            . sprintf(
                static::SUB_URL_SUBSCRIPTION,
                $subscriptionRequestEntity->getBusinessUuid(),
                $subscriptionRequestEntity->getThirdPartyName()
            );
    }

    /**
     * @param string $businessUuid
     *
     * @return string
     */
    protected function getBusinessInfoUrl($businessUuid)
    {
        return $this->getBaseUrl()
            . sprintf(static::SUB_URL_BUSINESS_INFO, $businessUuid);
    }

    /**
     * @param SubscriptionRequestEntity $subscriptionRequestEntity
     */
    private function fillSubscriptionEntityFromConfiguration(SubscriptionRequestEntity $subscriptionRequestEntity)
    {
        if (!$subscriptionRequestEntity->getBusinessUuid()) {
            $subscriptionRequestEntity->setBusinessUuid($this->configuration->getBusinessUuid());
        }
        if (!$subscriptionRequestEntity->getThirdPartyName()) {
            $subscriptionRequestEntity->setThirdPartyName($this->configuration->getChannelSet());
        }
    }
}
