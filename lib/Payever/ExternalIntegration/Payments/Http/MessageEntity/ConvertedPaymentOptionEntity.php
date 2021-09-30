<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * @method string getVariantId()
 * @method string getVariantName()
 * @method self setVariantId(string $variantId)
 * @method self setVariantName(string $variantName)
 */
class ConvertedPaymentOptionEntity extends ListPaymentOptionsResultEntity
{
    /** @var string */
    protected $variantId;

    /** @var string */
    protected $variantName;
}
