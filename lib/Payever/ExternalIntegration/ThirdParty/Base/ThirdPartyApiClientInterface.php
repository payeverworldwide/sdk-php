<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Base
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Base;

use Payever\ExternalIntegration\Core\Base\CommonApiClientInterface;
use Payever\ExternalIntegration\Core\Base\ResponseInterface;
use Payever\ExternalIntegration\Core\Http\Response;
use Payever\ExternalIntegration\ThirdParty\Http\RequestEntity\SubscriptionRequestEntity;

interface ThirdPartyApiClientInterface extends CommonApiClientInterface
{
    /**
     * Get current business entity
     *
     * @return ResponseInterface
     * @throws \Exception
     */
    public function getBusinessRequest();

    /**
     * Retrieves the subscription entity if client is subscribed
     *
     * @param SubscriptionRequestEntity $requestEntity
     *
     * @return Response
     * @throws \Exception
     */
    public function getSubscriptionStatus(SubscriptionRequestEntity $requestEntity);

    /**
     * Subscribe for a products data
     *
     * @param SubscriptionRequestEntity $requestEntity
     *
     * @return Response
     * @throws \Exception
     */
    public function subscribe(SubscriptionRequestEntity $requestEntity);

    /**
     * Unsubscribe from products data
     *
     * @param SubscriptionRequestEntity $requestEntity
     *
     * @return Response
     * @throws \Exception
     */
    public function unsubscribe(SubscriptionRequestEntity $requestEntity);
}
