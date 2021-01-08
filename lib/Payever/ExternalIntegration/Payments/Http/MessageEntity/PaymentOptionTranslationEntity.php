<?php
/**
 * This class represents Payment Option Translation Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Payment Option Translation Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string getLocale()
 * @method string getField()
 * @method string getContent()
 * @method self   setLocale()
 * @method self   setField()
 * @method self   setContent()
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
