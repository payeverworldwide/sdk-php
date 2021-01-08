<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method array|PaymentOptionVariantEntity[] getVariants()
 */
class ListPaymentOptionsVariantsResultEntity extends AbstractPaymentOptionEntity
{
    /** @var array|PaymentOptionVariantEntity[] */
    protected $variants = array();

    /**
     * @param array $rawVariants
     *
     * @return $this
     */
    public function setVariants(array $rawVariants)
    {
        foreach ($rawVariants as $rawVariant) {
            $this->variants[] = new PaymentOptionVariantEntity($rawVariant);
        }

        return $this;
    }

    /**
     * @return array|ConvertedPaymentOptionEntity[]
     */
    public function toConvertedPaymentOptions()
    {
        $result = array();
        $baseData = $this->toArray();

        foreach ($this->getVariants() as $variant) {
            $convertedOption = new ConvertedPaymentOptionEntity($baseData);
            $convertedOption->setVariantId($variant->getId());
            $convertedOption->setAcceptFee($variant->getAcceptFee());
            $convertedOption->setVariantName($variant->getName());

            $result[$variant->getId()] = $convertedOption;
        }

        return $result;
    }
}
