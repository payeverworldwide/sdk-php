<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  RequestEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;

/**
 * When sending entity to payever at least one of the following MUST be filled in: sku, uuid
 *
 * @method string getExternalId()
 * @method string getUuid()
 * @method string getSku()
 * @method self setExternalId(string $externalId)
 * @method self setSku(string $sku)
 * @method self setUuid(string $uuid)
 */
class ProductRemovedRequestEntity extends RequestEntity
{
    /** @var string */
    protected $externalId;

    /** @var array */
    protected $uuid;

    /** @var string */
    protected $sku;

    /**
     * @return array
     */
    public function getRequired()
    {
        return [
            'externalId',
            'sku',
        ];
    }
}
