<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  ResponseEntity
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;

class BusinessResponseEntity extends ResponseEntity
{
    /** @var array */
    protected $subscriptions;

    /** @var string */
    protected $name;

    /** @var string */
    protected $currency;

    /** @var array */
    protected $companyAddress;

    /** @var array */
    protected $contactDetails;

    /** @var array */
    protected $bankAccount;

    /** @var array */
    protected $contactEmails;
}
