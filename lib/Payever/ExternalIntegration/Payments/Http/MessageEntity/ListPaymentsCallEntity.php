<?php
/**
 * This class represents List Payments Call Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * This class represents List Payments Call Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string     getCurrency()
 * @method string     getState()
 * @method string|int getLimit()
 * @method self       setCurrency()
 * @method self       setState()
 * @method self       setLimit()
 */
class ListPaymentsCallEntity extends CallEntity
{
    /** @var string $currency */
    protected $currency;

    /** @var string $state */
    protected $state;

    /** @var string|int $limit */
    protected $limit;
}
