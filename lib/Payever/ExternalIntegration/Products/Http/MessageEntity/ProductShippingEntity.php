<?php

/**
 * PHP version 5.4 and 8
 *
 * @category  MessageEntity
 * @package   Payever\Products
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Products\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * @method string getMeasureMass()
 * @method string getMeasureSize()
 * @method bool getFree()
 * @method bool getGeneral()
 * @method float getWeight()
 * @method float getWidth()
 * @method float getLength()
 * @method float getHeight()
 * @method self setMeasureMass(string $measureMass)
 * @method self setMeasureSize(string $measureSize)
 * @method self setFree(bool $free)
 * @method self setGeneral(bool $general)
 * @method self setWeight(float $weight)
 * @method self setWidth(float $width)
 * @method self setLength(float $length)
 * @method self setHeight(float $height)
 */
class ProductShippingEntity extends MessageEntity
{
    /** @var string */
    protected $measureMass = 'kg';

    /** @var string */
    protected $measureSize = 'cm';

    /** @var bool */
    protected $free = false;

    /** @var bool */
    protected $general = false;

    /** @var float */
    protected $weight;

    /** @var float */
    protected $width;

    /** @var float */
    protected $length;

    /** @var float */
    protected $height;
}
