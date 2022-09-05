<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Entity\MTG\MtgManaCost;
use App\Repository\MTG\MtgColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgColorRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: [
        "get"
    ],
    itemOperations: [
        "get"
    ]
)]
class MtgColor
{
   use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 50)]
    private $code;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'color', targetEntity: MtgManaCost::class)]
    private Collection $mtgManaCosts;

    public function __construct()
    {
        $this->manaCosts = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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
     * @return Collection<int, MtgManaCost>
     */
    public function getManaCosts(): Collection
    {
        return $this->manaCosts;
    }

    public function addManaCost(MtgManaCost $manaCost): self
    {
        if (!$this->manaCosts->contains($manaCost)) {
            $this->manaCosts->add($manaCost);
            $manaCost->setColor($this);
        }

        return $this;
    }

    public function removeManaCost(MtgManaCost $manaCost): self
    {
        if ($this->manaCosts->removeElement($manaCost)) {
            // set the owning side to null (unless already changed)
            if ($manaCost->getColor() === $this) {
                $manaCost->setColor(null);
            }
        }

        return $this;
    }

}

