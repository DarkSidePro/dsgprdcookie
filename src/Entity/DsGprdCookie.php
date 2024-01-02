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

namespace DarkSide\DsGprdCookie\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\Repository\CookieRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGprdCookie
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
     * @ORM\Column(name="cookie_service", type="string", length=255)
     */
    private string $cookie_service;

    /**
     * @ORM\OneToMany(targetEntity=DsGprdCookieInCategory::class, mappedBy="cookie")
     */
    private Collection|DsGprdCookieInCategory $cookie_in_category;

    /**
     * @var string
     * 
     * @ORM\Column(name="cookie_name", type="string", length=255)
     */
    private string $cookie_name;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private bool $enabled;

    /**
     * @var Collection|DsGprdCookieLang[]
     * 
     * @ORM\OneToMany(targetEntity=DsGprdCookieLang::class, mappedBy="cookie")
     */
    private Collection|DsGprdCookieLang $cookie_langs;

      /**
     * @var string
     * 
     * @ORM\Column(name="script", type="text")
     */
    private string $script;

    /**
     * @var null|string
     * 
     * @ORM\Column(name="extra_script", type="text", nullable=true)
     */
    private null|string $extra_script;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", columnDefinition="ENUM('header', 'footer')") 
     */
    private string $position;

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
     * @return Collection|DsGprdCookieLang[]
     */
    public function getLangs(): Collection
    {
        return $this->cookie_langs;
    }

    public function addLang(DsGprdCookieLang $lang): self
    {
        if (!$this->cookie_langs->contains($lang)) {
            $this->cookie_langs[] = $lang;
            $lang->setCookie($this);
        }

        return $this;
    }

    public function removeLang(DsGprdCookieLang $lang): self
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
     * @return DsGprdCookieLang|null
     */
    public function getCookieLangByLangId(int $langId): ?DsGprdCookieLang
    {
        foreach ($this->cookie_langs as $cookieLang) {
            if ($langId === $cookieLang->getIdLang()) {
                return $cookieLang;
            }
        }
    
        return null;
    }

    /**
     * @return Collection<int, DsGprdCookieInCategory>
     */
    public function getCookieInCategories(): Collection
    {
        return $this->cookie_in_category;
    }

    public function addCookieInCategory(DsGprdCookieInCategory $dsGprdCookieInCategory): self
    {
        if (!$this->cookie_in_category->contains($dsGprdCookieInCategory)) {
            $this->cookie_in_category[] = $dsGprdCookieInCategory;
            $dsGprdCookieInCategory->setCookie($this);
        }

        return $this;
    }

    public function removeCookieInCategory(DsGprdCookieInCategory $dsGprdCookieInCategory): self
    {
        if ($this->cookie_in_category->removeElement($dsGprdCookieInCategory)) {
            // set the owning side to null (unless already changed)
            if ($dsGprdCookieInCategory->getCookie() === $this) {
                $dsGprdCookieInCategory->setCookie(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getScript(): ?string
    {
        return $this->script;
    }

    /**
     * @param string
     * 
     * @return self
     */
    public function setScript(string $script): self
    {
        $this->script = $script;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getExtraScript(): ?string
    {
        return $this->extra_script;
    }

    /**
     * @param null|string
     * 
     * @return self
     */
    public function setExtraScript(null|string $extra_script): self
    {
        $this->extra_script = $extra_script;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string
     * 
     * @return self
     */
    public function setPosition(string $position): self
    {
        if (in_array($position, ['header', 'footer'])) {
            $this->position = $position;
        }

        return $this;
    }
}
