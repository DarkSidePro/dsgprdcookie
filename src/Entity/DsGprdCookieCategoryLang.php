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
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\Repository\CookieCategoryLangRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGprdCookieCategoryLang
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
     * 
     * @ORM\Column(name="text_value", type="string", length=500)
     */
    private string $text_value;

   
    /**
     * @ORM\ManyToOne(targetEntity=DsGprdCookieCategory::class, inversedBy="category_langs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?DsGprdCookieCategory $category;

    /**
     * @var string
     * 
     * @ORM\Column(name="category_name", type="string", length=255)
     */
    private string $category_name;

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
     * @param string
     * 
     * @return void
     */
    public function setTextValue(string $text_value): self
    {
        $this->text_value = $text_value;

        return $this;
    }

     /**
     * @return DsGprdCookieCategory
     */
    public function getCategory(): DsGprdCookieCategory
    {
        return $this->category;
    }

    /**
     * @param DsGprdCookieCategory $category
     * 
     * @return self
     */
    public function setCategory(?DsGprdCookieCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     * 
     * @return self
     */
    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }
}
