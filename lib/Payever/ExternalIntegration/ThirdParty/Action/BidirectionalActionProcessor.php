<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\ThirdParty
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\ThirdParty\Action;

use Payever\ExternalIntegration\Inventory\Http\RequestEntity\InventoryChangedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRemovedRequestEntity;
use Payever\ExternalIntegration\Products\Http\RequestEntity\ProductRequestEntity;

class BidirectionalActionProcessor
{
    /** @var InwardActionProcessor */
    private $inwardActionProcessor;

    /** @var OutwardActionProcessor */
    private $outwardActionProcessor;

    public function __construct(
        InwardActionProcessor $inwardActionProcessor,
        OutwardActionProcessor $outwardActionProcessor
    ) {
        $this->inwardActionProcessor = $inwardActionProcessor;
        $this->outwardActionProcessor = $outwardActionProcessor;
    }

    /**
     * Do the job of processing payever third-party action request
     *
     * @param string $action - action name {@see ActionEnum}
     * @param array|string|null $payload - user can pass payload directly if it's coming from custom source
     *
     * @return ActionResult
     *
     * @throws \Exception - bubbles up anything thrown inside
     */
    public function processInwardAction($action, $payload = null)
    {
        $this->inwardActionProcessor->process($action, $payload);
    }

    /**
     * @param string $action - {@see ActionEnum}
     * @param InventoryChangedRequestEntity|ProductRequestEntity|ProductRemovedRequestEntity|array|string $payload
     *
     * @throws \RuntimeException - when given action is unknown
     * @throws \Exception - bubbles up anything thrown by API
     */
    public function processOutwardAction($action, $payload)
    {
        $this->outwardActionProcessor->process($action, $payload);
    }
}
