<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
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
