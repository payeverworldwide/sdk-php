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
 * @method self                    setId(string $id)
 * @method self                    setDeliveryFee(float $deliveryFee)
 * @method self                    setPaymentFee(float $paymentFee)
 * @method self                    setPrefilled(bool $prefilled)
 * @method self                    setSpecificStatus(string $specificStatus)
 * @method self                    setEmail(string $email)
 * @method self                    setStudent(bool $student)
 * @method self                    setCreditType(string $creditType)
 * @method self                    setCampaignCode(string $campaignCode)
 * @method self                    setApplicationNumber(string $applicationNumber)
 * @method self                    setMonthlyAmount(float $monthlyAmount)
 * @method self                    setCreditDurationInMonth(int $creditDurationInMonth)
 * @method self                    setDiscr(string $discr)
 * @method self                    setAcceptTermsCreditEurope(bool $acceptTermsCreditEurope)
 * @method self                    setApplicationNo(string $applicationNo)
 * @method self                    setApplicationStatus(string $applicationStatus)
 * @method self                    setBankDetailsSelection(string $bankDetailsSelection)
 * @method self                    setCreditAcceptsRequestsToCreditAgencies(bool $creditAcceptsRequestsToCreditAgencies)
 * @method self                    setCreditConfirmsSelfInitiative(bool $creditConfirmsSelfInitiative)
 * @method self                    setCreditDueDate(string $creditDueDate)
 * @method self                    setCreditDurationInMonths(int $creditDurationInMonths)
 * @method self                    setCreditProtectionInsurance(bool $creditProtectionInsurance)
 * @method self                    setEmploymentLimited(bool $employmentLimited)
 * @method self                    setFinanceId(string $financeId)
 * @method self                    setFreelancer(bool $freelancer)
 * @method self                    setInitialPayment(float $initialPayment)
 * @method self                    setPrevAddress(bool $prevAddress)
 * @method self                    setPrevEmploymentDetails(bool $prevEmploymentDetails)
 * @method self                    setUniqueId(string $uniqueId)
 * @method self                    setUsageText(string $usageText)
 * @method self                    setFrontendFinishUrl(string $frontendFinishUrl)
 * @method self                    setFrontendCancelUrl(string $frontendCancelUrl)
 * @method self                    setTransactionId(string $transactionId)
 * @method self                    setRedirectUrl(string $redirectUrl)
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
     * @return self
     */
    public function setCreditCalculation($creditCalculation)
    {
        $this->creditCalculation = new CreditCalculationEntity($creditCalculation);

        return $this;
    }

    /**
     * Sets Personal Date of Birth
     *
     * @param string $personalDateOfBirth
     * @return self
     */
    public function setPersonalDateOfBirth($personalDateOfBirth)
    {
        if ($personalDateOfBirth) {
            $this->personalDateOfBirth = date_create($personalDateOfBirth);
        }

        return $this;
    }

    /**
     * Sets Birthday
     *
     * @param string $birthday
     * @return self
     */
    public function setBirthday($birthday)
    {
        if ($birthday) {
            $this->birthday = date_create($birthday);
        }

        return $this;
    }
}
