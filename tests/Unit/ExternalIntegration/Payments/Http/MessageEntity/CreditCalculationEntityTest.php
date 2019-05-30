<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\CreditCalculationEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class CreditCalculationEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\CreditCalculationEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class CreditCalculationEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'product_type' => 'stub',
        'campaign_code' => 'string',
        'credit_duration' => 10,
        'kid' => 'string',
        'status_code' => 200,
        'status_description' => 'OK',
        'approved' => true,
        'decision_made' => true,
        'final' => true,
        'paid' => false,
        'flow_status_code' => 'finished',
        'bank_interest' => 100.5,
        'cpi_amount' => 200,
        'duration' => 10,
        'interest_rate' => 0.3,
        'monthly_rate' => 0.1,
        'price' => 200,
        'rate_pa' => 2.5,
        'total_amount' => 200,
    );

    public function getEntity()
    {
        return new CreditCalculationEntity();
    }
}
