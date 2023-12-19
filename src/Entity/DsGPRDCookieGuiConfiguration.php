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
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsOmnibus\Repository\PriceHistoryShopRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGPRDCookieGuiConfiguration
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_shop", type="integer")
     */
    private $id_shop;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_product", type="integer")
     */
    private $product;

    /**
     * @ORM\OneToMany(targetEntity="DsPriceAttributeHistoryShop", mappedBy="priceHistoryShop")
     */
    private $priceAttributeHistoriesShops;

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
     * @var DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    public function __construct()
    {
        $this->priceAttributeHistoriesShops = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

     /**
     * @param int $id_shop
     * 
     * @return void
     */
    public function setShopId(int $id_shop): void
    {
        $this->id_shop = $id_shop;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->id_shop;
    }

    /**
     * Set product
     * 
     * @param int
     * 
     * @return $this
     */
    public function setProduct(int $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     * 
     * @return int $product
     */
    public function getProduct(): int
    {
        return $this->product;
    }

    /**
     * @return Collection|PriceAttributeHistoryShop[]
     */
    public function getPriceAttributeHistoriesShops(): Collection
    {
        return $this->priceAttributeHistoriesShops;
    }

    /**
     * @param PriceAttributeHistoryShop $priceAttributeHistoryShop
     */
    public function addPriceAttributeHistoryShop(DsPriceAttributeHistoryShop $priceAttributeHistoryShop)
    {
        $this->priceAttributeHistoriesShops->add($priceAttributeHistoryShop);
        $priceAttributeHistoryShop->setPriceHistoryShop($this);
    }

    /**
     * @param PriceAttributeHistoryShop $priceAttributeHistoryShop
     */
    public function removePriceAttributeHistoryShop(DsPriceAttributeHistoryShop $priceAttributeHistoryShop)
    {
        $this->priceAttributeHistoriesShops->removeElement($priceAttributeHistoryShop);
        $priceAttributeHistoryShop->setPriceHistoryShop(null);
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
