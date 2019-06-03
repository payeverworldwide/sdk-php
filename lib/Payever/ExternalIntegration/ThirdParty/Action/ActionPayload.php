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

use Payever\ExternalIntegration\Core\Base\MessageEntity;
use Payever\ExternalIntegration\Inventory\Http\MessageEntity\InventoryChangedEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;
use Payever\ExternalIntegration\ThirdParty\Enum\Action;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */
class ActionPayload
{
    /** @var string */
    protected $action;

    /** @var string|array */
    protected $rawPayload;

    /**
     * ActionPayload constructor.
     *
     * @param string $action @see Action
     * @param string|array|null $rawPayload
     */
    public function __construct($action, $rawPayload = null)
    {
        $this->action = $action;
        $this->rawPayload = $rawPayload;
    }

    /**
     * @return MessageEntity
     *
     * @throws \UnexpectedValueException when can't fetch request payload
     * @throws \RuntimeException when can't map action to payload entity
     */
    public function getPayloadEntity()
    {
        if (!$this->rawPayload) {
            $this->rawPayload = $this->getRequestPayload();
        }

        if (!$this->rawPayload) {
            throw new \UnexpectedValueException('Got empty action request payload.', 40);
        }

        if (is_string($this->rawPayload)) {
            $payload = $this->unserializePayload($this->rawPayload);
        } else {
            $payload = $this->rawPayload;
        }

        if (isset($payload['payload'])) {
            $payload = $payload['payload'];
        }

        switch ($this->action) {
            case Action::ACTION_CREATE_PRODUCT:
            case Action::ACTION_UPDATE_PRODUCT:
                return new ProductRequestEntity($payload);
            case Action::ACTION_REMOVE_PRODUCT:
                return new ProductRemovedRequestEntity($payload);
            case Action::ACTION_ADD_INVENTORY:
            case Action::ACTION_SET_INVENTORY:
            case Action::ACTION_SUBTRACT_INVENTORY:
                return new InventoryChangedEntity($payload);
            default:
                throw new \RuntimeException(
                    sprintf('Payload entity not found for action %s', $this->action),
                    41
                );
        }
    }

    /**
     * @return false|array|string
     */
    public function getRawPayload()
    {
        return $this->rawPayload ?: $this->getRequestPayload();
    }

    /**
     * @param string $payload
     * @return array
     */
    protected function unserializePayload($payload)
    {
        return json_decode($payload, true);
    }

    /**
     * @return false|string
     */
    protected function getRequestPayload()
    {
        return file_get_contents('php://input');
    }
}
