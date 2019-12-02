<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\@PACKAGE
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
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
