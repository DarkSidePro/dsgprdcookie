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
 * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\Repository\CookieFieldRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGprdCookieField
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
     * @var string
     * 
     * @ORM\Column(name="field_name", type="string", length=255)
     */
    private string $field_name;

    /**
     * @ORM\OneToMany(targetEntity=DsGprdCookieFieldLang::class, mappedBy="field")
     */
    private Collection|DsGprdCookieFieldLang $langs;

    public function __construct()
    {
        $this->langs = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**  
     * @return string
     */    
    public function getFieldName(): string
    {
        return $this->field_name;
    }

    /**
     * @return Collection|DsGprdCookieFieldLang[]
     */
    public function getLangs(): Collection
    {
        return $this->langs;
    }

    public function addAnimalModel(DsGprdCookieFieldLang $lang): self
    {
        if (!$this->langs->contains($lang)) {
            $this->langs[] = $lang;
            $lang->setField($this);
        }

        return $this;
    }

    public function removeAnimalModel(DsGprdCookieFieldLang $lang): self
    {
        if ($this->langs->removeElement($lang)) {
            // set the owning side to null (unless already changed)
            if ($lang->getField() === $this) {
                $lang->setField(null);
            }
        }

        return $this;
    }
}
