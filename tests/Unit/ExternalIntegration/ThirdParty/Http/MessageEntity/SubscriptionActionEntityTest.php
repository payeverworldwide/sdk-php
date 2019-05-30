<?php

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

class SubscriptionActionEntityTest extends AbstractMessageEntityTest
{
    /** @var array */
    protected static $scheme = array(
        'name' => 'create-product',
        'url' => 'https://some.domain/action/create-produce',
        'method' => 'POST',
    );

    /**
     * @return MessageEntity|SubscriptionActionEntity
     */
    public function getEntity()
    {
        return new SubscriptionActionEntity();
    }
}
