<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Payment Option Translation Entity
 *
 * @method string getLocale()
 * @method string getField()
 * @method string getContent()
 * @method self   setLocale(string $locale)
 * @method self   setField(string $field)
 * @method self   setContent(string $content)
 */
class PaymentOptionTranslationEntity extends MessageEntity
{
    /** @var string $locale */
    protected $locale;

    /** @var string $field */
    protected $field;

    /** @var string $content */
    protected $content;
}
