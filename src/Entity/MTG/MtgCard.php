<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgCardRepository::class)]
#[ApiResource]
#[HasLifecycleCallbacks]
class MtgCard
{
    use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: MtgType::class, inversedBy: 'mtgCards')]
    private $mtgTypes;

    #[ORM\ManyToMany(targetEntity: MtgColor::class, inversedBy: 'mtgCards')]
    private $mtgColors;

    #[ORM\ManyToOne(targetEntity: MtgSet::class, inversedBy: 'mtgCards')]
    private $mtgSet;

    #[ORM\ManyToMany(targetEntity: MtgSubtype::class, inversedBy: 'mtgCards')]
    private $mtgSubtypes;

    #[ORM\ManyToMany(targetEntity: MtgSupertype::class, inversedBy: 'mtgCards')]
    private $SuperTypes;

    public function __construct()
    {
        $this->mtgTypes = new ArrayCollection();
        $this->mtgColors = new ArrayCollection();
        $this->mtgSubtypes = new ArrayCollection();
        $this->SuperTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, MtgType>
     */
    public function getMtgType(): Collection
    {
        return $this->mtgTypes;
    }

    public function addMtgType(MtgType $mtgType): self
    {
        if (!$this->mtgTypes->contains($mtgType)) {
            $this->mtgTypes[] = $mtgType;
        }

        return $this;
    }

    public function removeMtgType(MtgType $mtgType): self
    {
        $this->mtgTypes->removeElement($mtgType);

        return $this;
    }

    /**
     * @return Collection<int, MtgColor>
     */
    public function getMtgColors(): Collection
    {
        return $this->mtgColors;
    }

    public function addMtgColor(MtgColor $mtgColor): self
    {
        if (!$this->mtgColors->contains($mtgColor)) {
            $this->mtgColors[] = $mtgColor;
        }

        return $this;
    }

    public function removeMtgColor(MtgColor $mtgColor): self
    {
        $this->mtgColors->removeElement($mtgColor);

        return $this;
    }

    public function getMtgSet(): ?MtgSet
    {
        return $this->mtgSet;
    }

    public function setMtgSet(?MtgSet $mtgSet): self
    {
        $this->mtgSet = $mtgSet;

        return $this;
    }

    /**
     * @return Collection<int, MtgSubtype>
     */
    public function getMtgSubtypes(): Collection
    {
        return $this->mtgSubtypes;
    }

    public function addMtgSubtype(MtgSubtype $mtgSubtype): self
    {
        if (!$this->mtgSubtypes->contains($mtgSubtype)) {
            $this->mtgSubtypes[] = $mtgSubtype;
        }

        return $this;
    }

    public function removeMtgSubtype(MtgSubtype $mtgSubtype): self
    {
        $this->mtgSubtypes->removeElement($mtgSubtype);

        return $this;
    }

    /**
     * @return Collection<int, MtgSupertype>
     */
    public function getSuperTypes(): Collection
    {
        return $this->SuperTypes;
    }

    public function addSuperType(MtgSupertype $superType): self
    {
        if (!$this->SuperTypes->contains($superType)) {
            $this->SuperTypes[] = $superType;
        }

        return $this;
    }

    public function removeSuperType(MtgSupertype $superType): self
    {
        $this->SuperTypes->removeElement($superType);

        return $this;
    }
}
