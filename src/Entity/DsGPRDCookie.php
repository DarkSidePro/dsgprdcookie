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
 * @ORM\Entity(repositoryClass="DarkSide\DsGPRDCookie\Repository\PriceAttributeHistoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGPRDCookie
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
     * @ORM\Column(name="id_shop", type="integer")     
     */
    private int $id_shop;

    /**
     * @var string
     * 
     * @ORM\Column(name="cookie_service", type="string", length: 255)
     */
    private string $cookie_service;

    /**
     * @var DsGPRDCookieCategory
     * 
     * @ORM\OneToOne(targetEntity="DsGPRDCookieCategory", mappedBy="cookie", cascade={"persist". "remove"})
     */
    private DsGPRDCookieCategory $cookie_category;

    /**
     * @var string
     * 
     * @ORM\Column(name="cookie_name", type="string", length: 255)
     */
    private float $cookie_name;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="datetime")
     */
    private $enabled;

    /**
     * @var Collection|DsGPRDCookieLang[]
     * 
     * @ORM\OneToMany(targetEntity=DsGPRDCookieLang::class, mappedBy="cookie")
     */
    private Collection|DsGPRDCookieLang $cookie_langs;

    public function __construct()
    {
        $this->cookie_langs = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    * @return self 
    */
   public function setIdShop(int $id_shop): self
   {
        $this->id_shop = $id_shop;

        return $this;
   }
 
   /**
    * @return string
    */
    public function getCookieService(): string
    {
        return $this->cookie_service;
    }

    /**
     * @param string $cookie_service
     * 
     * @return self
     */
    public function setCookieService(string $cookie_service): self
    {
        $this->cookie_service = $cookie_service;

        return $this;
    }

    /**
     * @return DsGPRDCookieCategory
     */
    public function getCookieCategory(): DsGPRDCookieCategory
    {
        return $this->cookie_category;
    }

    /**
     * @param DsGPRDCookieCategory $cookie_category
     * 
     * @return self
     */
    public function setCookieCategory(DsGPRDCookieCategory $cookie_category): self
    {
        if ($cookie_category->getCookie() !== $this) {
            $cookie_category->setCookie($this);
        }

        $this->cookie_category = $cookie_category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCookieName(): string
    {
        return $this->cookie_name;
    }

    /**
     * @param string $cookie_name
     * 
     * @return self
     */
    public function setCookieName(string $cookie_name): self
    {
        $this->cookie_name = $cookie_name;

        return $this;
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

    /**
     * @return Collection|DsGPRDCookieLang[]
     */
    public function getLangs(): Collection
    {
        return $this->cookie_langs;
    }

    public function addLang(DsGPRDCookieLang $lang): self
    {
        if (!$this->cookie_langs->contains($lang)) {
            $this->cookie_langs[] = $lang;
            $lang->setCookie($this);
        }

        return $this;
    }

    public function removeLang(DsGPRDCookieLang $lang): self
    {
        if ($this->cookie_langs->removeElement($lang)) {
            // set the owning side to null (unless already changed)
            if ($lang->getCookie() === $this) {
                $lang->setCookie(null);
            }
        }

        return $this;
    }

    /**
     * @param int $langId
     * 
     * @return DsGPRDCookieLang|null
     */
    public function getCookieLangByLangId(int $langId)
    {
        foreach ($this->cookie_langs as $cookieLang) {
            if ($langId === $cookieLang->getIdLang()) {
                return $cookieLang;
            }
        }

        return null;
    }

}
