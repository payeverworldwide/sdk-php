<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Http\RequestEntity;

use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class SubscriptionRequestEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'businessUuid' => 'stub_business',
        'externalId' => 'abcd',
        'thirdPartyName' => 'magento',
    );

    public function getEntity()
    {
        return new SubscriptionRequestEntity();
    }
}
