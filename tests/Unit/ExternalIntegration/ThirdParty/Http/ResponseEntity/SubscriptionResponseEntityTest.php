<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\Tests\Unit\ExternalIntegration\ThirdParty\Http\ResponseEntity;

use Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity\SubscriptionResponseEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\ThirdParty\Http\MessageEntity\SubscriptionActionEntityTest;

class SubscriptionResponseEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'externalId' => null,
        'authorizationId' => 'abc123',
        'connected' => true,
        'actions' => array(),
        'updatedAt' => '2020-01-01T00:00:00+00:00',
    );

    public static function getScheme()
    {
        $scheme = parent::getScheme();

        $scheme['actions'][] = SubscriptionActionEntityTest::getScheme();

        return $scheme;
    }

    public function getEntity()
    {
        return new SubscriptionResponseEntity();
    }
}
