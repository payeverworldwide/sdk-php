<?php
/**
 * This class represents Payever API Channel Sets
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Core;

/**
 * This class represents Payever API Channel Sets
 *
 * PHP version 5.4
 *
 * @category  API
 * @package   Payever\Core
 * @author    Andrey Puhovsky <a.puhovsky@gmail.com>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */
class ChannelSet
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
    const CHANNEL_WOOCOMMERCE      = 'wooCommerce';
    const CHANNEL_PRESTA           = 'presta';
    const CHANNEL_MARKETING        = 'marketing';
    const CHANNEL_OFFER            = 'offer';
    const CHANNEL_ADVERTISING      = 'advertising';
    const CHANNEL_SHOPIFY          = 'shopify';
    const CHANNEL_OVERLAY          = 'overlay';
    const CHANNEL_OVERLAY_BANNER   = 'overlay_banner';
    const CHANNEL_DANDOMAIN        = 'dandomain';
    const CHANNEL_FINANCE_EXPRESS  = 'finance_express';

    /**
     * Returns available Channel Sets
     *
     * @return array
     */
    public static function getList()
    {
        return array(
            static::CHANNEL_ECONOMIC,
            static::CHANNEL_FACEBOOK,
            static::CHANNEL_WEEBLY,
            static::CHANNEL_STORE,
            static::CHANNEL_CHECKOUT,
            static::CHANNEL_SHOPWARE,
            static::CHANNEL_MAGENTO,
            static::CHANNEL_PLENTYMARKETS,
            static::CHANNEL_OTHER_SHOPSYSTEM,
            static::CHANNEL_JTL,
            static::CHANNEL_OXID,
            static::CHANNEL_XT_COMMERCE,
            static::CHANNEL_WOOCOMMERCE,
            static::CHANNEL_PRESTA,
            static::CHANNEL_MARKETING,
            static::CHANNEL_OFFER,
            static::CHANNEL_ADVERTISING,
            static::CHANNEL_SHOPIFY,
            static::CHANNEL_OVERLAY,
            static::CHANNEL_OVERLAY_BANNER,
            static::CHANNEL_DANDOMAIN,
            static::CHANNEL_FINANCE_EXPRESS,
        );
    }
}
