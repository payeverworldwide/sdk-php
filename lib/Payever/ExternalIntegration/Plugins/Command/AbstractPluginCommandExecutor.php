<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  Command
 * @package   Payever\Plugins
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;

/**
 * @SuppressWarnings(PHPMD.MissingImport)
 */
abstract class AbstractPluginCommandExecutor implements PluginCommandExecutorInterface
{
    /**
     * @param string $host
     *
     * @throws \UnexpectedValueException
     */
    protected function assertApiHostValid($host)
    {
        if (!filter_var($host, FILTER_VALIDATE_URL)) {
            throw new \UnexpectedValueException(sprintf('Command value %s is not a valid URL', $host));
        }
    }

    /**
     * @param PluginCommandEntity $commandEntity
     * @param string $sentenceDelimiter
     *
     * @return string - Message to show admin (with clickable HTML links)
     */
    protected function getNewPluginVersionNotificationText(
        PluginCommandEntity $commandEntity,
        $sentenceDelimiter = '. '
    ) {
        $pieces = [];
        $commandEntity->setMeta('value', $commandEntity->getValue());

        foreach ($this->getNewPluginVersionMetaTemplates() as $metaName => $template) {
            $meta = $commandEntity->getMeta($metaName);
            if (!empty($meta)) {
                $pieces[] = sprintf($template, $meta);
            }
        }

        return implode($sentenceDelimiter, $pieces);
    }

    /**
     * Feel free to override this method in your implementation to get customizable messages
     *
     * @return array|string[]
     */
    protected function getNewPluginVersionMetaTemplates()
    {
        return [
            'value' => 'New payever plugin version is available: %s',
            'filename' => 'You can download it <a href="%s" target="_blank">here</a>',
            'marketplaceLink' => 'You can also find this update <a href="%s" target="_blank">in marketplace</a>',
            'releaseNotes' => 'This update includes: %s',
            'callToAction' => '%s',
        ];
    }
}
