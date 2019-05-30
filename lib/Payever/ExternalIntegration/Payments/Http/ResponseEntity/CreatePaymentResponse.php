<?php
/**
 * This class represents Create Payment ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;
use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\CreatePaymentCallEntity;

/**
 * This class represents Create Payment ResponseInterface Entity
 *
 * PHP version 5.4
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2018 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://getpayever.com/shopsystem/
 *
 * @method string getRedirectUrl()
 * @method self   setRedirectUrl(string $url)
 */
class CreatePaymentResponse extends ResponseEntity
{
    /** @var string $redirectUrl */
    protected $redirectUrl;

    /**
     * {@inheritdoc}
     */
    public function getRequired()
    {
        $required = array(
            'call',
            'redirect_url',
        );

        return $required;
    }

    /**
     * {@inheritdoc}
     */
    public function isValid()
    {
        return parent::isValid() &&
            ($this->call   instanceof CallEntity   && $this->call->isValid()) &&
            ($this->result instanceof ResultEntity && $this->result->isValid() || !$this->result)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setCall($call)
    {
        $this->call = new CreatePaymentCallEntity($call);
    }
}
