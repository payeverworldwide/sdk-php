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
 * This class represents Shipping Address Entity
 *
 * @method string getSalutation()
 * @method float  getFirstName()
 * @method float  getLastName()
 * @method float  getStreet()
 * @method float  getStreetNumber()
 * @method string getZip()
 * @method string getCountry()
 * @method string getCity()
 * @method string getRegion()
 * @method string getAddressLine2()
 * @method self   setSalutation(string $salutation)
 * @method self   setFirstName(string $firstName)
 * @method self   setLastName(string $lastName)
 * @method self   setStreet(string $street)
 * @method self   setStreetNumber(string $streetNumber)
 * @method self   setZip(string $zip)
 * @method self   setCountry(string $country)
 * @method self   setCity(string $city)
 * @method self   setRegion(string $region)
 * @method self   setAddressLine2(string $addressLine2)
 */
class CustomerAddressEntity extends MessageEntity
{
    /** @var string $salutation */
    protected $salutation;

    /** @var string $firstName */
    protected $firstName;

    /** @var string $lastName */
    protected $lastName;

    /** @var string $street */
    protected $street;

    /** @var string $streetNumber */
    protected $streetNumber;

    /** @var string $zip */
    protected $zip;

    /** @var string $country */
    protected $country;

    /** @var string $city */
    protected $city;

    /** @var string $region */
    protected $region;

    /** @var string $addressLine2 */
    protected $addressLine2;
}
