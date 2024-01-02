
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
 * @ORM\Entity(repositoryClass="DarkSide\DsGprdCookie\CookieGuiConfigurationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class DsGprdCookieGuiConfiguration
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
     * @ORM\Column(name="field", type="string", length=255)
     */
    private string $field;

    /**
     * @ORM\OneToMany(targetEntity=DsGprdCookieGuiConfigurationValue::class, mappedBy="gui")
     */
    private Collection|DsGprdCookieGuiConfigurationValue $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
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
    public function getField(): string
    {
        return $this->field;
    }
    
    
    /**
     * @param string $field
     * 
     * @return self
     */
    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return Collection|DsGprdCookieGuiConfigurationValue[]
     */
    public function getValues(): Collection
    {
        return $this->values;
    }

    public function addValue(DsGprdCookieGuiConfigurationValue $value): self
    {
        if (!$this->values->contains($value)) {
            $this->values[] = $value;
            $value->getGui($this);
        }

        return $this;
    }

    public function removeValue(DsGprdCookieGuiConfigurationValue $value): self
    {
        if ($this->values->removeElement($value)) {
            // set the owning side to null (unless already changed)
            if ($value->getGui() === $this) {
                $value->setGui(null);
            }
        }

        return $this;
    }
}
