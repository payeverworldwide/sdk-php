<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Core
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Core\Base;

interface CommonApiClientInterface
{
    /**
     * Returns HTTP client
     *
     * @return HttpClientInterface
     */
    public function getHttpClient();

    /**
     * Sets HTTP client
     *
     * @param HttpClientInterface $httpClient
     *
     * @return static
     */
    public function setHttpClient(HttpClientInterface $httpClient);

    /**
     * Returns available Channel Sets
     *
     * @link https://getpayever.com/developer/api-documentation/#list-channel-sets Documentation
     *
     * @param string $businessUuid Business UUID
     *
     * @return ResponseInterface
     */
    public function listChannelSetsRequest($businessUuid);

    /**
     * Returns currencies available
     *
     * @param string $lang Language in ISO-2 format
     *
     * @return ResponseInterface
     */
    public function getCurrenciesRequest($lang);

    /**
     * Get OauthToken which will be used for further requests
     *
     * @link https://getpayever.com/developer/api-documentation/#authentication Documentation
     *
     * @param string $scope Scope in which the token will be used, {@see OauthTokenInterface}
     *
     * @return OauthTokenInterface
     */
    public function getToken($scope);

    /**
     * Returns base payever API endpoint
     *
     * @return string
     */
    public function getBaseUrl();
}
