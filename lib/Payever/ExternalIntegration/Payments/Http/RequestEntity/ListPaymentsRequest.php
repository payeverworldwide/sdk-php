<?php
/**
 * This class represents List Payments Request Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Payments\Status;

/**
 * This class represents List Payments Request Entity
 *
 * PHP version 5.4
 *
 * @category  RequestEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string     getAccessToken()
 * @method string     getPaymentMethod()
 * @method \DateTime  getDate()
 * @method string     getCurrency()
 * @method string     getState()
 * @method int|string getLimit()
 * @method self       setAccessToken(string $token)
 * @method self       setPaymentMethod(string $method)
 * @method self       setCurrency(string $currency)
 * @method self       setState(string $state)
 * @method self       setLimit(int|string $limit)
 */
class ListPaymentsRequest extends RequestEntity
{
    /** @var string $accessToken */
    protected $accessToken;

    /** @var string $paymentMethod */
    protected $paymentMethod;

    /** @var \DateTime $date */
    protected $date;

    /** @var string $currency */
    protected $currency;

    /** @var string $state */
    protected $state;

    /** @var int|string $limit */
    protected $limit;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        return array(
            'access_token',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            (!$this->date || $this->date instanceof \DateTime) &&
            (!$this->state || in_array($this->state, Status::getList())) &&
            (!$this->limit || is_integer($this->limit))
        ;
    }

    /**
     * Sets Date
     *
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = date_create($date);
    }
}
