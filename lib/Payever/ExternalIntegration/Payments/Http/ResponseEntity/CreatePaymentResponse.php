<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  ResponseEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Http\MessageEntity\CallEntity;
use Payever\ExternalIntegration\Core\Http\MessageEntity\ResultEntity;
use Payever\ExternalIntegration\Core\Http\ResponseEntity;
use Payever\ExternalIntegration\Payments\Http\MessageEntity\CreatePaymentCallEntity;

/**
 * This class represents Create Payment ResponseInterface Entity
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
        return [
            'call',
            'redirect_url',
        ];
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
