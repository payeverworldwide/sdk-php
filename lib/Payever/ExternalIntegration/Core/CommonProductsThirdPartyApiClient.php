<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Core
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core;

/**
 * Common Products Third Party API Client
 */
class CommonProductsThirdPartyApiClient extends CommonApiClient
{
    const URL_SANDBOX = 'https://products-third-party.staging.devpayever.com/';
    const URL_LIVE    = 'https://products-third-party.payever.org/';
}
