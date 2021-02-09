<?php

/**
 * PHP version 5.4 and 7
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
 * This class represents Credit Calculation Entity
 *
 * @method string getProductType()
 * @method string getCampaignCode()
 * @method int    getCreditDuration()
 * @method string getKid()
 * @method string getStatusCode()
 * @method string getStatusDescription()
 * @method bool   getApproved()
 * @method bool   getDecisionMade()
 * @method bool   getFinal()
 * @method bool   getPaid()
 * @method string getFlowStatusCode()
 * @method float  getBankInterest()
 * @method float  getCpiAmount()
 * @method int    getDuration()
 * @method float  getInterestRate()
 * @method float  getMonthlyRate()
 * @method float  getPrice()
 * @method float  getRatePa()
 * @method float  getTotalAmount()
 * @method self   setProductType()
 * @method self   setCampaignCode()
 * @method self   setCreditDuration()
 * @method self   setKid()
 * @method self   setStatusCode()
 * @method self   setStatusDescription()
 * @method self   setApproved()
 * @method self   setDecisionMade()
 * @method self   setFinal()
 * @method self   setPaid()
 * @method self   setFlowStatusCode()
 * @method self   setBankInterest()
 * @method self   setCpiAmount()
 * @method self   setDuration()
 * @method self   setInterestRate()
 * @method self   setMonthlyRate()
 * @method self   setPrice()
 * @method self   setRatePa()
 * @method self   setTotalAmount()
 */
class CreditCalculationEntity extends MessageEntity
{
    /** @var string $productType */
    protected $productType;

    /** @var string $campaignCode */
    protected $campaignCode;

    /** @var int $creditDuration */
    protected $creditDuration;

    /** @var string $kid */
    protected $kid;

    /** @var string $statusCode */
    protected $statusCode;

    /** @var string $statusDescription */
    protected $statusDescription;

    /** @var bool $approved */
    protected $approved;

    /** @var bool $decisionMade */
    protected $decisionMade;

    /** @var bool $final */
    protected $final;

    /** @var bool $paid */
    protected $paid;

    /** @var string $flowStatusCode */
    protected $flowStatusCode;

    /** @var float $bankInterest */
    protected $bankInterest;

    /** @var float $cpiAmount */
    protected $cpiAmount;

    /** @var int $duration */
    protected $duration;

    /** @var float $interestRate */
    protected $interestRate;

    /** @var float $monthlyRate */
    protected $monthlyRate;

    /** @var float $price */
    protected $price;

    /** @var float $ratePa */
    protected $ratePa;

    /** @var float $totalAmount */
    protected $totalAmount;
}
