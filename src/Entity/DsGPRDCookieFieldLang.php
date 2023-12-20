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
 * @ORM\Entity(repositoryClass="DarkSide\DsGPRDCookie\Repository\SpecificPriceHistoryShopRepository")
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
     * @ORM\Column(name="id_lang", type="integer")
     */
    private int $id_lang;

    /**
     * @var string
     * 
     * @ORM\Column(name="text_value", type="string", length: 4096)
     */
    private string $text_value;

     /**
     * @ORM\ManyToOne(targetEntity=DsGPRDCookieField::class, inversedBy="langs")
     * @ORM\JoinColumn(nullable=false)
     */
    private Collection|DsGPRDCookieField $field;

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
    public function getIdLang(): int
    {
        return $this->id_lang;
    }

    /**
     * @param int $id_lang
     * 
     * @return self
     */
    public function setIdLang(int $id_lang): self
    {
        $this->id_lang = $id_lang;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextValue(): string 
    {
        return $this->text_value;    
    }

    /**
     * @param string $text_value
     * 
     * @return self
     */
    public function setTextValue(string $text_value): self
    {
        $this->text_value = $text_value;

        return $this;
    }

    /**
     * @return DsGPRDCookieField
     */
    public function getField() : DsGPRDCookieField 
    {
        return $this->field;    
    }

    /**
     * @param ?DsGPRDCookieField $field
     * 
     * @return self
     */
    public function setField(?DsGPRDCookieField $field): self
    {
        $this->field = $field;

        return $this;
    }
}
