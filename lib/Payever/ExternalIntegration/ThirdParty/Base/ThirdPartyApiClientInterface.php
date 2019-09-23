<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Base;

use Payever\ExternalIntegration\Core\Base\CommonApiClientInterface;
use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Core\Http\Response;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface ThirdPartyApiClientInterface extends CommonApiClientInterface
{
    /**
     * Get current business entity
     *
     * @return ResponseInterface
     */
    public function getBusinessRequest();

    /**
     * Retrieves the subscription entity if client is subscribed
     *
     * @param SubscriptionRequestEntity $subscriptionRequestEntity
     *
     * @return Response
     */
    public function getSubscriptionStatus(SubscriptionRequestEntity $subscriptionRequestEntity);

    /**
     * Subscribe for a products data
     *
     * @param SubscriptionRequestEntity $subscriptionRequestEntity
     *
     * @return Response
     */
    public function subscribe(SubscriptionRequestEntity $subscriptionRequestEntity);

    /**
     * Unsubscribe from products data
     *
     * @param SubscriptionRequestEntity $subscriptionRequestEntity
     *
     * @return Response
     */
    public function unsubscribe(SubscriptionRequestEntity $subscriptionRequestEntity);
}
