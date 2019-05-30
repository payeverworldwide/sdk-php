<?php

namespace Payever\ExternalIntegration\Core\Base;

interface HttpClientInterface
{
    public function execute(RequestInterface $request);
}
