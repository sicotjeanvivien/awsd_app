<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgSupertypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgSupertypeRepository::class)]
#[ApiResource]
#[HasLifecycleCallbacks]
class MtgSupertype
{

    use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\ManyToMany(targetEntity: MtgCard::class, mappedBy: 'SuperTypes')]
    private $mtgCards;

    public function __construct()
    {
        $this->mtgCards = new ArrayCollection();
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
     * @return Collection<int, MtgCard>
     */
    public function getMtgCards(): Collection
    {
        return $this->mtgCards;
    }

    public function addMtgCard(MtgCard $mtgCard): self
    {
        if (!$this->mtgCards->contains($mtgCard)) {
            $this->mtgCards[] = $mtgCard;
            $mtgCard->addSuperType($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->mtgCards->removeElement($mtgCard)) {
            $mtgCard->removeSuperType($this);
        }

        return $this;
    }
}
