<?php
/**
 * This class represents Payment Option Options Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Payment Option Options Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method array getCurrencies()
 * @method array getCountries()
 * @method array getActions()
 * @method self  setCurrencies()
 * @method self  setCountries()
 * @method self  setActions()
 */
class PaymentOptionOptionsEntity extends MessageEntity
{
    /** @var array $currencies */
    protected $currencies;

    /** @var array $countries */
    protected $countries;

    /** @var array $actions */
    protected $actions;
}
