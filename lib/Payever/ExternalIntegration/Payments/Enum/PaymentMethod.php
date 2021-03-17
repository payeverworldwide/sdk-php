<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Enum
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Enum;

use Payever\ExternalIntegration\Core\Base\EnumerableConstants;

/**
 * List of available for external integration payever payment methods
 */
class PaymentMethod extends EnumerableConstants
{
    const METHOD_SANTANDER_DE_FACTORING = 'santander_factoring_de';
    const METHOD_SANTANDER_DE_INVOICE = 'santander_invoice_de';
    const METHOD_SANTANDER_NO_INVOICE = 'santander_invoice_no';
    const METHOD_SANTANDER_DE_INSTALLMENT = 'santander_installment';
    const METHOD_SANTANDER_DE_CCP_INSTALLMENT = 'santander_ccp_installment';
    const METHOD_SANTANDER_NO_INSTALLMENT = 'santander_installment_no';
    const METHOD_SANTANDER_DK_INSTALLMENT = 'santander_installment_dk';
    const METHOD_SANTANDER_SE_INSTALLMENT = 'santander_installment_se';
    const METHOD_INSTANT_PAYMENT = 'instant_payment';

    const METHOD_SOFORT = 'sofort';
    const METHOD_PAYMILL_CREDIT_CARD = 'paymill_creditcard';
    const METHOD_PAYMILL_DIRECT_DEBIT = 'paymill_directdebit';
    const METHOD_PAYPAL = 'paypal';
    const METHOD_STRIPE_CREDIT_CARD = 'stripe';
    const METHOD_STRIPE_DIRECT_DEBIT = 'stripe_directdebit';
    const METHOD_PAYEX_FAKTURA = 'payex_faktura';
    const METHOD_PAYEX_CREDIT_CARD = 'payex_creditcard';

    /**
     * Whether payment method must be hidden when shipping address differs from billing one
     *
     * @param string $method
     *
     * @return bool
     */
    public static function shouldHideOnDifferentAddress($method)
    {
        return in_array($method, static::getShouldHideOnDifferentAddressMethods());
    }

    /**
     * Whether payment method must be hidden after first unsuccessful payment attempt
     *
     * @param string $method
     *
     * @return bool
     */
    public static function shouldHideOnReject($method)
    {
        return in_array($method, static::getShouldHideOnRejectMethods());
    }

    /**
     * @return array
     */
    public static function getShouldHideOnDifferentAddressMethods()
    {
        return [
            static::METHOD_SANTANDER_DE_FACTORING,
            static::METHOD_SANTANDER_DE_INVOICE,
            static::METHOD_PAYEX_FAKTURA,
        ];
    }

    /**
     * @return array
     */
    public static function getShouldHideOnRejectMethods()
    {
        return [
            static::METHOD_SANTANDER_DE_FACTORING,
            static::METHOD_SANTANDER_DE_INVOICE,
        ];
    }
}
