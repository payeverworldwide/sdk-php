<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentDetailsEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class PaymentDetailsEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\PaymentDetailsEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class PaymentDetailsEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'delivery_fee' => 10,
        'payment_fee' => 20,
        'prefilled' => false,
        'specific_status' => 'DECLINED',
        'email' => 'some@domain.com',
        'student' => false,
        'credit_type' => 'type',
        'campaign_code' => 'CODE',
        'application_number' => 'NUMBER',
        'monthly_amount' => 145.32,
        'credit_duration_in_month' => 12,
        'credit_calculation' => array(),
        'discr' => 'stub_description',
        'accept_terms_credit_europe' => true,
        'application_no' => 'application_num',
        'application_status' => 'OK',
        'finance_id' => 'finance_id',
        'freelancer' => false,
        'personal_date_of_birth' => self::DEFAULT_STUB_DATE,
    );

    public function getEntity()
    {
        return new PaymentDetailsEntity();
    }
}
