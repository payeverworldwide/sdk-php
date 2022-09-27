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
 * This class represents Address Entity
 *
 * @method string getId()
 * @method string getUuid()
 * @method string getCountry()
 * @method string getCountryName()
 * @method string getCity()
 * @method string getRegion()
 * @method string getZipCode()
 * @method string getFullStreet()
 * @method string getStreet()
 * @method string getStreetNumber()
 * @method string getSalutation()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getPhone()
 * @method string getEmail()
 * @method string getType()
 * @method self   setId(string $id)
 * @method self   setUuid(string $uuid)
 * @method self   setCountry(string $country)
 * @method self   setCountryName(string $countryName)
 * @method self   setCity(string $city)
 * @method self   setRegion(string $region)
 * @method self   setZipCode(string $zipCode)
 * @method self   setFullStreet(string $fullStreet)
 * @method self   setStreet(string $street)
 * @method self   setStreetNumber(string $streetNumber)
 * @method self   setSalutation(string $salutation)
 * @method self   setFirstName(string $firstName)
 * @method self   setLastName(string $lastName)
 * @method self   setPhone(string $phone)
 * @method self   setEmail(string $email)
 * @method self   setType(string $type)
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class AddressEntity extends MessageEntity
{
    /** @var string $id */
    protected $id;

    /** @var string $uuid */
    protected $uuid;

    /** @var string $country */
    protected $country;

    /** @var string $countryName */
    protected $countryName;

    /** @var string $city */
    protected $city;

    /** @var string $region */
    protected $region;

    /** @var string $zipCode */
    protected $zipCode;

    /** @var string $fullStreet */
    protected $fullStreet;

    /** @var string $street */
    protected $street;

    /** @var string $streetNumber */
    protected $streetNumber;

    /** @var string $salutation */
    protected $salutation;

    /** @var string $firstName */
    protected $firstName;

    /** @var string $lastName */
    protected $lastName;

    /** @var string $phone */
    protected $phone;

    /** @var string $email */
    protected $email;

    /** @var string $type */
    protected $type;
}
