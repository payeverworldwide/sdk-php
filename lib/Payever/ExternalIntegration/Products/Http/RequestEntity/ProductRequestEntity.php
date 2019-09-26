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
 * @method bool getEnabled()
 * @method bool getInventoryTrackingEnabled()
 * @method string getUuid()
 * @method string getBusinessUuid()
 * @method ProductCategoryEntity[]|string[] getCategories()
 * @method string getCurrency()
 * @method string getTitle()
 * @method string getDescription()
 * @method float getPrice()
 * @method float|null getSalePrice()
 * @method string getSku()
 * @method int getInventory()
 * @method string getBarcode()
 * @method string getType()
 * @method self[]|null getVariants()
 * @method ProductShippingEntity|null getShipping()
 * @method \DateTime|false getCreatedAt()
 * @method \DateTime|false getUpdatedAt()
 * @method self setExternalId(string $externalId)
 * @method self setImages(array $images)
 * @method self setImagesUrl(array $imagesUrl)
 * @method self setEnabled(bool $enabled)
 * @method self setInventoryTrackingEnabled(bool $enabled)
 * @method self setUuid(string $uuid)
 * @method self setBusinessUuid(string $businessUuid)
 * @method self setCurrency(string $currency)
 * @method self setTitle(string $title)
 * @method self setDescription(string $description)
 * @method self setPrice(float $price)
 * @method self setSku(string $sku)
 * @method self setInventory(int $inventory)
 * @method self setBarcode(string $barcode)
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
    protected $enabled = true;

    /** @var bool */
    protected $inventoryTrackingEnabled = false;

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

    /**
     * Read as 'salePriceHidden'
     *
     * @var bool
     */
    protected $hidden = true;

    /** @var float */
    protected $sortPrice;

    /** @var string */
    protected $sku;

    /** @var int */
    protected $inventory;

    /** @var string */
    protected $barcode;

    /** @var string */
    protected $type;

    /** @var self[]|null */
    protected $variants;

    /** @var ProductShippingEntity|null */
    protected $shipping;

    /** @var \DateTime|bool */
    protected $createdAt;

    /** @var \DateTime|bool */
    protected $updatedAt;

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
     */
    public function addVariant($variant)
    {
        if (is_array($variant)) {
            $variant = new static($variant);
            $variant->setCurrency($this->getCurrency());
        }

        $this->variants[] = $variant;
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
     * @param float $price
     *
     * @return self
     */
    public function setSalePrice($price)
    {
        $this->salePrice = $price;
        $this->hidden = !$price;

        return $this;
    }
}
