<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgSubtypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgSubtypeRepository::class)]
#[ApiResource]
#[HasLifecycleCallbacks]
class MtgSubtype
{

    use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\ManyToMany(targetEntity: MtgCard::class, mappedBy: 'mtgSubtypes')]
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
            $mtgCard->addMtgSubtype($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->mtgCards->removeElement($mtgCard)) {
            $mtgCard->removeMtgSubtype($this);
        }

        return $this;
    }
}
