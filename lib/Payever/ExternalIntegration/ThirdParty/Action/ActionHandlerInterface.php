<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

/**
 * Interface ActionHandlerInterface
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
interface ActionHandlerInterface
{
    /**
     * Must tell us what action this handler intends to handle.
     *
     * @see ActionEnum
     *
     * @return string
     */
    public function getSupportedAction();

    /**
     * Must handle action and throw exception if anything goes wrong.
     *
     * @param ActionPayload $actionPayload
     * @param ActionResult $actionResult
     *
     * @return void - All results must be represented through given ActionResult instance
     *
     * @throws \Exception - when action couldn't be handled, must have meaningful message
     */
    public function handle(ActionPayload $actionPayload, ActionResult $actionResult);
}
