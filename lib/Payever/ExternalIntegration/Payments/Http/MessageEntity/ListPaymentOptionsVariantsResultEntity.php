<?php

/**
 * PHP version 5.4 and 7
 *
 * @category  MessageEntity
 * @package   Payever\Payments
 * @author    payever GmbH <service@payever.de>
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2021 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/shopsystems/api/getting-started
 */

namespace Payever\ExternalIntegration\Payments\Http\MessageEntity;

/**
 * @method array|PaymentOptionVariantEntity[] getVariants()
 */
class ListPaymentOptionsVariantsResultEntity extends AbstractPaymentOptionEntity
{
    /** @var array|PaymentOptionVariantEntity[] */
    protected $variants = [];

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
        $result = [];
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
