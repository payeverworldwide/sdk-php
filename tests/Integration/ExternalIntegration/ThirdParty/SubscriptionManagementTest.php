<?php

namespace Payever\Tests\Integration\ExternalIntegration\ThirdParty;

use Payever\ExternalIntegration\ThirdParty\Enum\ActionEnum;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;

class SubscriptionManagementTest extends ThirdPartyBaseTest
{
    const TEST_EXTERNAL_ID = 'stub_external_id';

    public function testSubscribe()
    {
        $action = new SubscriptionActionEntity();
        $action->setName(ActionEnum::ACTION_CREATE_PRODUCT);
        $action->setMethod('POST');
        $action->setUrl('https://some.domain/');

        $entity = $this->getBaseSubscriptionEntity();
        $entity->addAction($action);

        $this->thirdPartyApiClient->subscribe($entity);

        $configuration = $this->thirdPartyApiClient->getConfiguration();

        $this->assertActualRequestData([
            'path' => sprintf(
                '/api/business/%s/integration/%s',
                $configuration->getBusinessUuid(),
                $configuration->getChannelSet()
            ),
            'method' => 'POST',
            'body' => $entity->toArray(),
        ]);
    }

    /**
     * @depends testSubscribe
     */
    public function testRetrieveSubscription()
    {
        $entity = $this->getBaseSubscriptionEntity();

        $subscription = $this->thirdPartyApiClient->getSubscriptionStatus($entity);

        $this->assertEquals($entity->getExternalId(), $subscription->getResponseEntity()->getExternalId());

        $configuration = $this->thirdPartyApiClient->getConfiguration();

        $this->assertActualRequestData([
            'path' => sprintf(
                '/api/business/%s/connection/authorization/%s',
                $configuration->getBusinessUuid(),
                $entity->getExternalId()
            ),
            'method' => 'GET',
        ]);
    }

    /**
     * @depends testSubscribe
     */
    public function testUnsubscribe()
    {
        $entity = $this->getBaseSubscriptionEntity();

        $this->thirdPartyApiClient->unsubscribe($entity);

        $configuration = $this->thirdPartyApiClient->getConfiguration();

        $this->assertActualRequestData([
            'path' => sprintf(
                '/api/business/%s/connection/authorization/%s',
                $configuration->getBusinessUuid(),
                $entity->getExternalId()
            ),
            'method' => 'DELETE',
        ]);
    }

    /**
     * @return SubscriptionRequestEntity
     */
    private function getBaseSubscriptionEntity()
    {
        $entity = new SubscriptionRequestEntity();
        $entity->setExternalId(self::TEST_EXTERNAL_ID);

        return $entity;
    }
}
