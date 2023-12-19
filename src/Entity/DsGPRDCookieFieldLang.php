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
 * @ORM\Entity(repositoryClass="DarkSide\DsOmnibus\Repository\SpecificPriceHistoryShopRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGPRDCookieFieldLang
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
     * @ORM\Column(name="id_shop_default", type="integer")
     */
    private $id_shop_default;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_product", type="integer")
     */
    private $id_product;

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

    /**
     * @ORM\OneToMany(targetEntity="PriceAttributeHistory", mappedBy="priceHistory")
     */
    private $priceAttributeHistories;

    public function __construct()
    {
        $this->priceAttributeHistories = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id_shop_default
     * 
     * @return void
     */
    public function setIdShopDefault(int $id_shop_default): void
    {
        $this->id_shop_default = $id_shop_default;
    }

    /**
     * @return int
     */
    public function getIdShopDefault()
    {
        return $this->id_shop_default;
    }

    /**
     * @return int
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param int $id_product
     * 
     * @return void
     */
    public function setIdProduct(int $id_product): void
    {
        $this->id_product = $id_product;
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
     * @return Collection|PriceAttributeHistory[]
     */
    public function getPriceAttributeHistories(): Collection
    {
        return $this->priceAttributeHistories;
    }

    /**
     * @param PriceAttributeHistory $priceAttributeHistory
     */
    public function addPriceAttributeHistory(PriceAttributeHistory $priceAttributeHistory)
    {
        $this->priceAttributeHistories->add($priceAttributeHistory);
        $priceAttributeHistory->setPriceHistory($this);
    }

    /**
     * @param PriceAttributeHistory $priceAttributeHistory
     */
    public function removePriceAttributeHistory(PriceAttributeHistory $priceAttributeHistory)
    {
        $this->priceAttributeHistories->removeElement($priceAttributeHistory);
        $priceAttributeHistory->setPriceHistory(null);
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
