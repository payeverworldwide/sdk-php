<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Converter;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\ConvertedPaymentOptionEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\ListPaymentOptionsVariantsResultEntity;

class PaymentOptionConverter
{
    /**
     * @param array|ListPaymentOptionsVariantsResultEntity[] $poWithVariants
     *
     * @return array|ConvertedPaymentOptionEntity[]
     */
    public static function convertPaymentOptionVariants(array $poWithVariants)
    {
        $result = array();

        foreach ($poWithVariants as $poWithVariant) {
            $result = array_merge($result, $poWithVariant->toConvertedPaymentOptions());
        }

        return $result;
    }
}
