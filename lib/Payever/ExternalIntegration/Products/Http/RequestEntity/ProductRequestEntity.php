<?php
/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 */

namespace Payever\ExternalIntegration\Products\Http\RequestEntity;

use Payever\ExternalIntegration\Core\Http\RequestEntity;
use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductCategoryEntity;
use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductShippingEntity;
use Payever\ExternalIntegration\Products\Http\MessageEntity\ProductVariantOptionEntity;

/**
 * PHP version 5.4 and 7
 *
 * @package   Payever\Products
 * @author    Hennadii.Shymanskyi <gendosua@gmail.com>
 * @copyright 2017-2019 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 *
 * @method string getExternalId()
 * @method string[] getImages()
 * @method string[] getImagesUrl()
 * @method bool getActive()
 * @method string getUuid()
 * @method string getBusinessUuid()
 * @method ProductCategoryEntity[]|string[] getCategories()
 * @method string getCurrency()
 * @method string getTitle()
 * @method string getDescription()
 * @method float getPrice()
 * @method float|null getSalePrice()
 * @method bool getOnSales()
 * @method string getSku()
 * @method string getBarcode()
 * @method float getVatRate()
 * @method ProductVariantOptionEntity[]|array getOptions()
 * @method string getType()
 * @method self[]|array getVariants()
 * @method ProductShippingEntity|null getShipping()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method self setExternalId(string $externalId)
 * @method self setImages(array $images)
 * @method self setImagesUrl(array $imagesUrl)
 * @method self setActive(bool $active)
 * @method self setUuid(string $uuid)
 * @method self setBusinessUuid(string $businessUuid)
 * @method self setCurrency(string $currency)
 * @method self setTitle(string $title)
 * @method self setDescription(string $description)
 * @method self setPrice(float $price)
 * @method self setOnSales(bool $onSales)
 * @method self setSku(string $sku)
 * @method self setBarcode(string $barcode)
 * @method self setVatRate(float $vatRate)
 * @method self setType(string $type)
 */
class ProductRequestEntity extends RequestEntity
{
    const UNDERSCORE_ON_SERIALIZATION = false;

    /**
     * Subscription external id.
     * Required for all requests.
     *
     * @var string
     */
    protected $externalId;

    /** @var array */
    protected $images = array();

    /** @var array */
    protected $imagesUrl = array();

    /** @var bool */
    protected $active = true;

    /** @var string */
    protected $uuid;

    /** @var string */
    protected $businessUuid;

    /** @var ProductCategoryEntity[]|string[] */
    protected $categories = array();

    /** @var string */
    protected $currency;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var float */
    protected $price;

    /** @var float|null */
    protected $salePrice;

    /** @var bool */
    protected $onSales = false;

    /** @var string */
    protected $sku;

    /** @var string */
    protected $barcode;

    /** @var string */
    protected $type;

    /** @var float */
    protected $vatRate;

    /** @var self[]|array */
    protected $variants = array();

    /** @var ProductShippingEntity|null */
    protected $shipping;

    /** @var \DateTime|bool */
    protected $createdAt;

    /** @var \DateTime|bool */
    protected $updatedAt;

    /**
     * Available only for product variants
     *
     * @var ProductVariantOptionEntity[]|array
     */
    protected $options = array();

    /**
     * @param string $updatedAt
     *
     * @return static
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = date_create($updatedAt);

        return $this;
    }

    /**
     * @param string $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = date_create($createdAt);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function setShipping($data)
    {
        $this->shipping = new ProductShippingEntity($data);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return static
     */
    public function setCategories($data)
    {
        foreach ($data as $plainCategory) {
            /** Both ProductCategoryEntity fields array and simple title are possible */
            $this->categories[] = is_array($plainCategory)
                ? new ProductCategoryEntity($plainCategory)
                : $plainCategory
            ;
        }

        return $this;
    }

    /**
     * @param array[]|static[] $data
     *
     * @return static
     */
    public function setVariants($data)
    {
        foreach ($data as $variant) {
            $this->addVariant($variant);
        }

        return $this;
    }

    /**
     * @param array|static $variant
     *
     * @return self
     */
    public function addVariant($variant)
    {
        if (is_array($variant)) {
            $variant = new static($variant);
            $variant->setCurrency($this->getCurrency());
        }

        $this->variants[] = $variant;

        return $this;
    }

    /**
     * Set product variant option
     *
     * @param array $options
     *
     * @return self
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $option) {
                $this->options[] = new ProductVariantOptionEntity($option);
            }
        }

        return $this;
    }

    /**
     * Add product variant option
     *
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    public function addOption($name, $value)
    {
        $this->options[] = new ProductVariantOptionEntity(compact('name', 'value'));

        return $this;
    }

    /**
     * @return array
     */
    public function getImagesUuid()
    {
        return array_map(
            function ($imageName) {
                return substr($imageName, 0, strpos($imageName, '.'));
            },
            $this->getImages()
        );
    }

    /**
     * @param float $salePrice
     *
     * @return self
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;
        $this->onSales = $salePrice > 0 && (!$this->getPrice() || $this->getPrice() > $salePrice);

        return $this;
    }
}
