<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  API
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

/**
 * This class represents Payever API Channel Sets
 */
class ChannelSet extends EnumerableConstants
{
    const CHANNEL_ECONOMIC         = 'e-conomic';
    const CHANNEL_FACEBOOK         = 'facebook';
    const CHANNEL_WEEBLY           = 'weebly';
    const CHANNEL_STORE            = 'store';
    const CHANNEL_CHECKOUT         = 'checkout';
    const CHANNEL_SHOPWARE         = 'shopware';
    const CHANNEL_MAGENTO          = 'magento';
    const CHANNEL_PLENTYMARKETS    = 'plentymarkets';
    const CHANNEL_OTHER_SHOPSYSTEM = 'other_shopsystem';
    const CHANNEL_JTL              = 'jtl';
    const CHANNEL_OXID             = 'oxid';
    const CHANNEL_XT_COMMERCE      = 'xt_commerce';
    const CHANNEL_WOOCOMMERCE      = 'woo_commerce';
    const CHANNEL_PRESTA           = 'presta';
    const CHANNEL_MARKETING        = 'marketing';
    const CHANNEL_OFFER            = 'offer';
    const CHANNEL_ADVERTISING      = 'advertising';
    const CHANNEL_SHOPIFY          = 'shopify';
    const CHANNEL_OVERLAY          = 'overlay';
    const CHANNEL_OVERLAY_BANNER   = 'overlay_banner';
    const CHANNEL_DANDOMAIN        = 'dandomain';
    const CHANNEL_FINANCE_EXPRESS  = 'finance_express';
}
