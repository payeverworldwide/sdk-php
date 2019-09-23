<?php

namespace Payever\Tests\Unit\ExternalIntegration\Plugins\Http\ResponseEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Plugins\Http\ResponseEntity\CommandsResponseEntity;
use Payever\Tests\Unit\ExternalIntegration\Core\Http\AbstractMessageEntityTest;
use Payever\Tests\Unit\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntityTest;

class CommandsResponseEntityTest extends AbstractMessageEntityTest
{
    public static function getScheme()
    {
        static::$scheme = [
            PluginCommandEntityTest::getScheme()
        ];

        return parent::getScheme();
    }

    public function getEntity()
    {
        return new CommandsResponseEntity();
    }

    protected function compareFields(MessageEntity $entity, array $fields)
    {
        if ($entity instanceof CommandsResponseEntity) {
            $fields = [
                'commands' => static::$scheme,
            ];
        }

        return parent::compareFields($entity, $fields);
    }
}
