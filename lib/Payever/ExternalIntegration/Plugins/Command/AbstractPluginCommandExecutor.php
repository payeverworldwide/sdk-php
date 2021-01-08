<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Plugins
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Plugins\Command;

use Payever\ExternalIntegration\Plugins\Http\MessageEntity\PluginCommandEntity;

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
        $pieces = array();
        $commandEntity->setMeta('value', $commandEntity->getValue());

        foreach ($this->getNewPluginVersionMetaTemplates() as $metaName => $template) {
            if ($commandEntity->getMeta($metaName)) {
                $pieces[] = sprintf($template, $commandEntity->getMeta($metaName));
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
        return array(
            'value' => 'New payever plugin version is available: %s',
            'filename' => 'You can download it <a href="%s" target="_blank">here</a>',
            'marketplaceLink' => 'You can also find this update <a href="%s" target="_blank">in marketplace</a>',
            'releaseNotes' => 'This update includes: %s',
            'callToAction' => '%s',
        );
    }
}
