<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Core
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Core\Http\MessageEntity;

/**
 * This class represents Get Currencies Result Entity
 *
 * @method string getId()
 * @method string getSymbol()
 * @method string getCode()
 * @method float  getRate()
 * @method self   setId(string $id)
 * @method self   setSymbol(string $symbol)
 * @method self   setCode(string $code)
 * @method self   setRate(float $rate)
 */
class GetCurrenciesResultEntity extends ResultEntity
{
    /** @var string $id */
    protected $name;

    /** @var string $symbol */
    protected $symbol;

    /** @var string $code */
    protected $code;

    /** @var float $rate */
    protected $rate;
}
