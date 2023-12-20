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

namespace DarkSide\DsGPRDCookie\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsGPRDCookie\Repository\PriceHistoryShopRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGPRDCookieGuiConfigurationValue
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
     * @var string
     * 
     * @ORM\Column(name="field_value", type="string", length: 255)
     */
    private $field_value;

    /**
     * @ORM\ManyToOne(targetEntity=DsGPRDCookieGuiConfiguration::class, inversedBy="values")
     * @ORM\JoinColumn(nullable=false)
     */
    private Collection|DsGPRDCookieGuiConfiguration $gui;

    /**
     * @var bool
     * 
     * @ORM\Column(name="enabled", type="bool")
     */
    private bool $enabled;


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
     * @param string $field_value
     * 
     * @return self
     */
    public function setFieldValue(int $field_value): self
    {
        $this->field_value = $field_value;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldValue(): string
    {
        return $this->field_value;
    }

    /**
     * @param null|DsGPRDCookieGuiConfiguration
     * 
     * @return self
     */
    public function setGui(?DsGPRDCookieGuiConfiguration $gui): self
    {
        $this->gui = $gui;

        return $this;
    }

    /**
     * @return DsGPRDCookieGuiConfiguration
     */
    public function getGui(): DsGPRDCookieGuiConfiguration
    {
        return $this->gui;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * 
     * @return self
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
   
}
