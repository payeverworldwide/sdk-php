<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  Converter
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
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
        $result = [];

        foreach ($poWithVariants as $poWithVariant) {
            $result = array_merge($result, $poWithVariant->toConvertedPaymentOptions());
        }

        return $result;
    }
}
