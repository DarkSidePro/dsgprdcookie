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
class DsGPRDCookieField
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
     * @ORM\Column(name="id_specific_price", type="integer")
     */
    private int $id_specific_price;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_product", type="integer")
     */
    private int $id_product;


    /**
     * @var float
     * 
     * @ORM\Column(name="price", type="decimal", precision=20, scale=6)
     */
    private float $price;

    /**
     * @var float
     * 
     * @ORM\Column(name="reduction", type="decimal", precision=20, scale=6)
     */
    private float $reduction;

    /**
     * @var int
     * 
     * @ORM\Column(name="reduction_tax", type="integer")
     */
    private int $reduction_tax;

    /**
     * @var string
     * 
     * @ORM\Column(name="reduction_type", type="string", columnDefinition="ENUM('amount','percentage')")
     */
    private string $reduction_type;

    /**
     * @var int
     * 
     * @ORM\Column(name="id_shop", type="integer")
     */
    private int $id_shop;

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
    public function getSpecificPriceId(): int
    {
        return $this->id_specific_price;
    }

    /**
     * @param int
     * 
     * @return void
     */
    public function setSpecificPriceId(int $id_specific_price): void
    {
        $this->id_specific_price = $id_specific_price;
    }

    public function setProducId(int $id_product): void
    {
        $this->id_product = $id_product;
    }

    public function getProductId(): int
    {
        return $this->id_product;
    }

    /**
     * Price from reduction is made
     * 
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float
     * 
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Reduction amount value 
     * 
     * @return float
     */
    public function getReduction(): float
    {
        return $this->reduction;
    }

    /**
     * @param float
     * 
     * @return void
     */
    public function setReduction(float $reduction): void
    {
        $this->reduction = $reduction;
    }

    /**
     * With or without tax
     * 
     * @return int
     */
    public function getReductionTax(): int
    {
        return $this->reduction_tax;
    }

    /**
     * @param int
     * 
     * @return void
     */
    public function setReductionTax(int $reduction_tax): void
    {
        $this->reduction_tax = $reduction_tax;
    }

    /**
     * Reduction type: amount or percentage
     * 
     * @return string
     */
    public function getReductionType(): string
    {
        return $this->reduction_type;
    }

    /**
     * @param string
     * 
     * @return void
     */
    public function setReductionType(string $reduction_type): void
    {
        $this->reduction_type = $reduction_type;
    } 

    /**
     * Set dateAdd.
     *
     * @param DateTime $dateAdd
     *
     * @return $this
     */
    private function setDateAdd(DateTime $dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->id_shop;
    }

    /**
     * @param int
     * 
     * @return void
     */
    public function setShopId(int $id_shop): void
    {
        $this->id_shop = $id_shop;
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
