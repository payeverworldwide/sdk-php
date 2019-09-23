<?php
/**
 * This class represents Address Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * This class represents Address Entity
 *
 * PHP version 5.4
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string getId()
 * @method string getUuid()
 * @method string getCountry()
 * @method string getCountryName()
 * @method string getCity()
 * @method string getZipCode()
 * @method string getFullStreet()
 * @method string getStreet()
 * @method string getStreetNumber()
 * @method string getSalutation()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getType()
 * @method self   setId()
 * @method self   setUuid()
 * @method self   setCountry()
 * @method self   setCountryName()
 * @method self   setCity()
 * @method self   setZipCode()
 * @method self   setFullStreet()
 * @method self   setStreet()
 * @method self   setStreetNumber()
 * @method self   setSalutation()
 * @method self   setFirstName()
 * @method self   setLastName()
 * @method self   setType()
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

    /** @var string $type */
    protected $type;
}
