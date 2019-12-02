<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

use Payever\ExternalIntegration\Core\Base\MessageEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getVariantId()
 * @method null|string getName()
 * @method bool getAcceptFee()
 */
class PaymentOptionVariantEntity extends MessageEntity
{
    /** @var string - Variant UUID */
    protected $variantId;

    /** @var null|string - Variant name */
    protected $name;

    /** @var bool */
    protected $acceptFee;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->variantId;
    }
}
