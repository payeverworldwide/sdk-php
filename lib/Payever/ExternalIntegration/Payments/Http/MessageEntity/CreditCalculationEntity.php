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
 * @method self   setProductType(string $productType)
 * @method self   setCampaignCode(string $campaignCode)
 * @method self   setCreditDuration(int $creditDuration)
 * @method self   setKid(string $kid)
 * @method self   setStatusCode(string $statusCode)
 * @method self   setStatusDescription(string $statusDescription)
 * @method self   setApproved(bool $approved)
 * @method self   setDecisionMade(bool $decisionMade)
 * @method self   setFinal(bool $final)
 * @method self   setPaid(bool $paid)
 * @method self   setFlowStatusCode(string $flowStatusCode)
 * @method self   setBankInterest(float $bankInterest)
 * @method self   setCpiAmount(float $cpiAmount)
 * @method self   setDuration(int $duration)
 * @method self   setInterestRate(float $interestRate)
 * @method self   setMonthlyRate(float $monthlyRate)
 * @method self   setPrice(float $price)
 * @method self   setRatePa(float $ratePa)
 * @method self   setTotalAmount(float $totalAmount)
 *
 * @SuppressWarnings(PHPMD.TooManyFields)
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
