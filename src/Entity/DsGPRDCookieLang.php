<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 */
declare(strict_types=1);

namespace DarkSide\DsOmnibus\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsOmnibus\Repository\PriceAttributeHistoryShopRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGPRDCookieLang
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_product_attribute", type="integer")
     */
    private int $id_product_attribute;

    /**
     * @var int
     * @ORM\Column(name="id_shop", type="integer")
     */
    private int $id_shop;

    /**
     * @var float
     * 
     * @ORM\Column(name="wholesale_price", type="decilmal", precision=20, scale=6)
     */
    private float $wholesale_price;

    /**
     * @var float
     * 
     * @ORM\Column(name="price", type="decimal", precision=20, scale=6)
     */
    private float $price;

    /**
     * @var ProductHistoryShop
     * 
     * @ORM\ManyToOne(targetEntity="ProductHistoryShop", inversedBy="priceAttributeHistoryShop")
     * @ORM\JoinColumn(name="price_history_shop_id", referencedColumnName="id")     
     */
    private PriceHistoryShop $priceHistoryShop;


    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdProductAttribute(): int
    {
        return $this->id_product_attribute;
    }

    /**
     * @param int $id_product_attribute
     * 
     * @return void
     */
    public function setIdProductAttribute(int $id_product_attribute): void
    {
        $this->id_product_attribute = $id_product_attribute;
    }

    /**
     * @return int
     */
    public function getIdShop(): int
    {
        return $this->id_shop;
    }

    /**
     * @param int $id_shop
     * 
     * @return void
     */
    public function setIdShop(int $id_shop): void
    {
        $this->id_shop = $id_shop;
    }

    /**
     * @return float
     */
    public function getWholesalePrice(): float
    {
        return $this->wholesale_price;
    }

    /**
     * @param float $wholesale_price
     * 
     * @return void
     */
    public function setWholesalePrice(float $wholesale_price): void
    {
        $this->wholesale_price = $wholesale_price;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * 
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return PriceHistoryShop
     */
    public function getPriceHistoryShop(): PriceHistoryShop
    {
        return $this->priceHistoryShop;
    }

    /**
     * @param PriceHistoryShop|null $priceHistoryShop
     */
    public function setPriceHistoryShop(?PriceHistoryShop $priceHistoryShop)
    {
        $this->priceHistoryShop = $priceHistoryShop;
    }

    /**
     * Set dateAdd.
     *
     * @param DateTime $dateAdd
     *
     * @return $this
     */
    public function setDateAdd(DateTime $dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd.
     *
     * @return DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        if ($this->getDateAdd() == null) {
            $this->setDateAdd(new DateTime());
        }
    }
}
