<?php

namespace Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Payments\Http\MessageEntity\AddressEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;

/**
 * Class AddressEntityTest
 *
 * @see \Payever\ExternalIntegration\Payments\Http\MessageEntity\AddressEntity
 *
 * @package Payever\Tests\Unit\ExternalIntegration\Payments\Http\MessageEntity
 */
class AddressEntityTest extends AbstractMessageEntityTest
{
    protected static $scheme = array(
        'id' => 'stub',
        'uuid' => 'stub',
        'country' => 'DE',
        'country_name' => 'Germany',
        'city' => 'Berlin',
        'zip_code' => '10111',
        'full_street' => 'Some Strasse 32',
        'street' => 'Some Strasse',
        'street_number' => '32',
        'salutation' => 'MR',
        'first_name' => 'Name',
        'last_name' => 'Lastname',
        'type' => 'none',
    );

    public function getEntity()
    {
        return new AddressEntity();
    }
}
