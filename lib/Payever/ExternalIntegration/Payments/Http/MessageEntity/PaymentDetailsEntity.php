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
 * This class represents Payment Details Entity
 *
 * @method string                  getId()
 * @method float                   getDeliveryFee()
 * @method float                   getPaymentFee()
 * @method bool                    getPrefilled()
 * @method string                  getSpecificStatus()
 * @method string                  getEmail()
 * @method bool                    getStudent()
 * @method string                  getCreditType()
 * @method string                  getCampaignCode()
 * @method string                  getApplicationNumber()
 * @method float                   getMonthlyAmount()
 * @method int                     getCreditDurationInMonth()
 * @method CreditCalculationEntity getCreditCalculation()
 * @method string                  getDiscr()
 * @method bool                    getAcceptTermsCreditEurope()
 * @method string                  getApplicationNo()
 * @method string                  getApplicationStatus()
 * @method string                  getBankDetailsSelection()
 * @method bool                    getCreditAcceptsRequestsToCreditAgencies()
 * @method bool                    getCreditConfirmsSelfInitiative()
 * @method string                  getCreditDueDate()
 * @method int                     getCreditDurationInMonths()
 * @method bool                    getCreditProtectionInsurance()
 * @method bool                    getEmploymentLimited()
 * @method string                  getFinanceId()
 * @method bool                    getFreelancer()
 * @method float                   getInitialPayment()
 * @method \DateTime|false         getPersonalDateOfBirth()
 * @method bool                    getPrevAddress()
 * @method bool                    getPrevEmploymentDetails()
 * @method string                  getUniqueId()
 * @method string                  getUsageText()
 * @method \DateTime|false         getBirthday()
 * @method string                  getFrontendFinishUrl()
 * @method string                  getFrontendCancelUrl()
 * @method string                  getTransactionId()
 * @method string                  getRedirectUrl()
 * @method self                    setId()
 * @method self                    setDeliveryFee()
 * @method self                    setPaymentFee()
 * @method self                    setPrefilled()
 * @method self                    setSpecificStatus()
 * @method self                    setEmail()
 * @method self                    setStudent()
 * @method self                    setCreditType()
 * @method self                    setCampaignCode()
 * @method self                    setApplicationNumber()
 * @method self                    setMonthlyAmount()
 * @method self                    setCreditDurationInMonth()
 * @method self                    setDiscr()
 * @method self                    setAcceptTermsCreditEurope()
 * @method self                    setApplicationNo()
 * @method self                    setApplicationStatus()
 * @method self                    setBankDetailsSelection()
 * @method self                    setCreditAcceptsRequestsToCreditAgencies()
 * @method self                    setCreditConfirmsSelfInitiative()
 * @method self                    setCreditDueDate()
 * @method self                    setCreditDurationInMonths()
 * @method self                    setCreditProtectionInsurance()
 * @method self                    setEmploymentLimited()
 * @method self                    setFinanceId()
 * @method self                    setFreelancer()
 * @method self                    setInitialPayment()
 * @method self                    setPrevAddress()
 * @method self                    setPrevEmploymentDetails()
 * @method self                    setUniqueId()
 * @method self                    setUsageText()
 * @method self                    setFrontendFinishUrl()
 * @method self                    setFrontendCancelUrl()
 * @method self                    setTransactionId()
 * @method self                    setRedirectUrl()
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class PaymentDetailsEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var float $deliveryFee */
    protected $deliveryFee;

    /** @var float $paymentFee */
    protected $paymentFee;

    /** @var bool $prefilled */
    protected $prefilled;

    /** @var string $specificStatus */
    protected $specificStatus;

    /** @var string $email */
    protected $email;

    /** @var bool $student */
    protected $student;

    /** @var string $creditType */
    protected $creditType;

    /** @var string $campaignCode */
    protected $campaignCode;

    /** @var string $applicationNumber */
    protected $applicationNumber;

    /** @var float $monthlyAmount */
    protected $monthlyAmount;

    /** @var int $creditDurationInMonth */
    protected $creditDurationInMonth;

    /** @var CreditCalculationEntity $creditCalculation */
    protected $creditCalculation;

    /** @var string $discr */
    protected $discr;

    /** @var bool $acceptTermsCreditEurope */
    protected $acceptTermsCreditEurope;

    /** @var string $applicationNo */
    protected $applicationNo;

    /** @var string $applicationStatus */
    protected $applicationStatus;

    /** @var string $bankDetailsSelection */
    protected $bankDetailsSelection;

    /** @var bool $creditAcceptsRequestsToCreditAgencies */
    protected $creditAcceptsRequestsToCreditAgencies;

    /** @var bool $creditConfirmsSelfInitiative */
    protected $creditConfirmsSelfInitiative;

    /** @var string $creditDueDate */
    protected $creditDueDate;

    /** @var int $creditDurationInMonths */
    protected $creditDurationInMonths;

    /** @var bool $creditProtectionInsurance */
    protected $creditProtectionInsurance;

    /** @var bool $employmentLimited */
    protected $employmentLimited;

    /** @var string $financeId */
    protected $financeId;

    /** @var bool $freelancer */
    protected $freelancer;

    /** @var float $initialPayment */
    protected $initialPayment;

    /** @var \DateTime|bool $personalDateOfBirth */
    protected $personalDateOfBirth;

    /** @var bool $prevAddress */
    protected $prevAddress;

    /** @var bool $prevEmploymentDetails */
    protected $prevEmploymentDetails;

    /** @var string */
    protected $uniqueId;

    /** @var string */
    protected $usageText;

    /** @var \DateTime|bool */
    protected $birthday;

    /** @var string */
    protected $frontendFinishUrl;

    /** @var string */
    protected $frontendCancelUrl;

    /** @var string */
    protected $transactionId;

    /** @var string */
    protected $redirectUrl;

    /**
     * Sets Credit Calculation
     *
     * @param array $creditCalculation
     */
    public function setCreditCalculation($creditCalculation)
    {
        $this->creditCalculation = new CreditCalculationEntity($creditCalculation);
    }

    /**
     * Sets Personal Date of Birth
     *
     * @param string $personalDateOfBirth
     */
    public function setPersonalDateOfBirth($personalDateOfBirth)
    {
        $this->personalDateOfBirth = date_create($personalDateOfBirth);
    }

    /**
     * Sets Birthday
     *
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = date_create($birthday);
    }
}
