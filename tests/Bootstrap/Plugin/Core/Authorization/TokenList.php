<?php

namespace Payever\Tests\Bootstrap\Plugin\Core\Authorization;

use Payever\ExternalIntegration\Core\Authorization\TokenList as CoreTokenList;

class TokenList extends CoreTokenList
{
    /**
     * {@inheritdoc}
     */
    public function load()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new Token();
    }
}
