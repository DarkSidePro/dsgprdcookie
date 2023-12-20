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
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsGPRDCookie\Repository\PriceAttributeHistoryShopRepository")
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
     * @ORM\Column(name="id_lang", type="integer")
     */
    private int $id_lang;

    /**
     * @var string
     * @ORM\Column(name="text_value", type="string", length: 255)
     */
    private string $text_value;

    /**
     * @ORM\ManyToOne(targetEntity=DsGPRDCookie::class, inversedBy="cookie_langs")
     * @ORM\JoinColumn(nullable=false)
     */
    private DsGPRDCookie $cookie;

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
     * @return DsGPRDCookie
     */
    public function getCookie(): DsGPRDCookie
    {
        return $this->cookie;
    }

    /**
     * @param DsGPRDCookie $cookie
     * 
     * @return $self
     */
    public function setCookie(?DsGPRDCookie $cookie): self
    {
        $this->cookie = $cookie;

        return $this;
    }
}

