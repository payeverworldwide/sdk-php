<?php

namespace Payever\Tests\Bootstrap\Plugin\Payments;

use Payever\ExternalIntegration\Payments\Api as PaymentsApi;
use Payever\Tests\Bootstrap\Plugin\Core\Authorization\TokenList;

class Api extends PaymentsApi
{
    /**
     * {@inheritdoc}
     */
    protected function loadConfiguration()
    {
        $this->configuration = new Configuration();
        $this
            ->getConfiguration()
            ->load()
        ;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadTokens()
    {
        $this->tokens = new TokenList();
        $this
            ->getTokens()
            ->load()
        ;

        return $this;
    }
}
