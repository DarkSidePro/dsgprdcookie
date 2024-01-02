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
use DoctrineExtensions\Query\Mysql\NullIf;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\Repository\CookieCategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGprdCookieCategory
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

    /** 
     * @ORM\Column(type="string", columnDefinition="ENUM('necessary', 'analytics', 'ads', '')") 
     */
    private string $type;

    /**
     * @ORM\OneToMany(targetEntity=DsGprdCookieCategoryLang::class, mappedBy="category")
     */
    private Collection|DsGprdCookieCategoryLang $category_langs;

    /**
     * @ORM\OneToMany(targetEntity=DsGprdCookieInCategory::class, mappedBy="category")
     */
    private Collection|DsGprdCookieInCategory $cookie_in_categories;

    public function __construct()
    {
        $this->category_langs = new ArrayCollection();
        $this->cookie_in_categories = new ArrayCollection();
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
     * @return self
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
     * @return Collection|DsGprdCookieCategoryLang[]
     */
    public function getCategoryLangs(): Collection
    {
        return $this->category_langs;
    }

    public function addCategoryLang(DsGprdCookieCategoryLang $lang): self
    {
        if (!$this->category_langs->contains($lang)) {
            $this->category_langs[] = $lang;
            $lang->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryLang(DsGprdCookieCategoryLang $lang): self
    {
        if ($this->category_langs->removeElement($lang)) {
            // set the owning side to null (unless already changed)
            if ($lang->getCategory() === $this) {
                $lang->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @param int $id_lang
     * 
     * @return ?array
     */
    public function getCategoryLangForLang(int $langId): ?DsGprdCookieCategoryLang
    {
        foreach ($this->getCategoryLangs() as $categoryLang) {
            if ($categoryLang->getIdLang() === $langId) {
                return $categoryLang;
            }
        }

        return null;
    }

    /**
     * @return Collection<int, DsGprdCookieInCategory>
     */
    public function getCookieInCategories(): Collection
    {
        return $this->cookie_in_categories;
    }

    public function addCookieInCategory(DsGprdCookieInCategory $dsGprdCookieInCategory): self
    {
        if (!$this->cookie_in_categories->contains($dsGprdCookieInCategory)) {
            $this->cookie_in_categories[] = $dsGprdCookieInCategory;
            $dsGprdCookieInCategory->setCategory($this);
        }

        return $this;
    }

    public function removeCookieInCategory(DsGprdCookieInCategory $dsGprdCookieInCategory): self
    {
        if ($this->cookie_in_categories->removeElement($dsGprdCookieInCategory)) {
            // set the owning side to null (unless already changed)
            if ($dsGprdCookieInCategory->getCategory() === $this) {
                $dsGprdCookieInCategory->setCategory(null);
            }
        }

        return $this;
    }
}
