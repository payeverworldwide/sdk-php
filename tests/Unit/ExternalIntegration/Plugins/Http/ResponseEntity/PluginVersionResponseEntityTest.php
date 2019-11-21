<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\PluginVersionResponseEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractResponseEntityTest;

class PluginVersionResponseEntityTest extends AbstractResponseEntityTest
{
    protected static $scheme = [
        'filename' => 'https://payeverproduction.blob.core.windows.net/miscellaneous/e6480202-9cac-4a1b-bfc2-98729b8ed52b-payever-magento2-payments-2.13.0.zip',
        'version' => '2.12.1',
        'maxCmsVersion' => '1.6.0',
        'minCmsVersion' => '1.0.0',
        'createdAt' => '2019-10-25T12:23:28+00:00',
    ];

    public function getEntity()
    {
        return new PluginVersionResponseEntity();
    }
}
