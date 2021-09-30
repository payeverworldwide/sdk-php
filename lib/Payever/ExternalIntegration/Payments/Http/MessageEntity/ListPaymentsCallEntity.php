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

use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;

/**
 * This class represents List Payments Call Entity
 *
 * @method string     getCurrency()
 * @method string     getState()
 * @method string|int getLimit()
 * @method self       setCurrency(string $currency)
 * @method self       setState(string $state)
 * @method self       setLimit(string $limit)
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
