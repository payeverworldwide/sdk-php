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
 * This class represents Payment Option Options Entity
 *
 * @method array getCurrencies()
 * @method array getCountries()
 * @method array getActions()
 * @method self  setCurrencies(array $currencies)
 * @method self  setCountries(array $countries)
 * @method self  setActions(array $actions)
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
