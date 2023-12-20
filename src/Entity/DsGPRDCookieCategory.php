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
class DsGPRDCookieCategory
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
     * @ORM\Column(type="boolean")
     */
    private bool $default_enabled;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $readonly;

    /** @Column(type="string", columnDefinition="ENUM('necessary', 'analytics', 'ads', '')") */
    private string $type;

    /**
     * @ORM\OneToOne(targetEntity=DsGPRDCookie::class, mappedBy="cookie_category", cascade={"persist", "remove"})
     */
    private DsGPRDCookie $cookie;

    /**
     * @ORM\OneToMany(targetEntity=DsGPRDCookieCategoryLangs::class, mappedBy="category")
     */
    private Collection|DsGPRDCookieCategoryLang $category_langs;

    public function __construct()
    {
        $this->category_langs = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getDefaultEnabled(): bool
    {
        return $this->default_enabled;
    }

    /**
     * @param bool $default_enabled
     * 
     * @return self
     */
    public function setDefaultEnabled(bool $default_enabled): self
    {
        $this->default_enabled = $default_enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReadonly(): bool
    {
        return $this->readonly;
    }

    /**
     * @param bool @readonly
     * 
     * @return self
     */
    public function setReadonly(bool $readonly): self
    {
        $this->readonly = $readonly;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * 
     * @return $this
     */
    public function setType(string $type): self
    {
        $expectedValue = ['necessary', 'analytics', 'ads', ''];

        if (in_array($type, $expectedValue)) {
            $this->type = $type;
        }

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
     * @return self
     */
    public function setCookie(DsGPRDCookie $cookie): self
    {
        if ($cookie->getCookieCategory() !== $this) {
            $cookie->setCookieCategory($this);
        }

        $this->cookie = $cookie;

        return $this;
    }

    /**
     * @return Collection|DsGPRDCookieCategoryLang[]
     */
    public function getCategoryLangs(): Collection
    {
        return $this->category_langs;
    }

    public function addMilkParameter(DsGPRDCookieCategoryLang $lang): self
    {
        if (!$this->category_langs->contains($lang)) {
            $this->category_langs[] = $lang;
            $lang->setCategory($this);
        }

        return $this;
    }

    public function removeMilkParameter(DsGPRDCookieCategoryLang $lang): self
    {
        if ($this->category_langs->removeElement($lang)) {
            // set the owning side to null (unless already changed)
            if ($lang->getCategory() === $this) {
                $lang->setCategory(null);
            }
        }

        return $this;
    }
}
