<?php

namespace Base\Plugin\Payever\Payments;

require_once '../../../src/Payever/ExternalIntegration/Payments/Api.php';

use Base\Plugin\Payever\Core\TokenList;
use \Payever\ExternalIntegration\Payments\Api as PaymentsApi;

class Api extends PaymentsApi
{
    protected function loadConfiguration()
    {
        $this->configuration = new Configuration();
        $this
            ->getConfiguration()
            ->load()
        ;
    }

    protected function loadTokens()
    {
        $this->tokens = new TokenList();
        $this
            ->getTokens()
            ->load($this->getConfiguration()->getClientId())
        ;
    }
}
