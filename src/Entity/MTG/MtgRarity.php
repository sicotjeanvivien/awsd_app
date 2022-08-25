<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgRarityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgRarityRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get"
    ],
    itemOperations: [
        "get"
    ]
)]
#[HasLifecycleCallbacks]
class MtgRarity
{

    use CommunAttributesTrait;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'mtgRarity', targetEntity: MtgCard::class)]
    private Collection $MtgCards;

    public function __construct()
    {
        $this->MtgCards = new ArrayCollection();
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
        return $this->MtgCards;
    }

    public function addMtgCard(MtgCard $mtgCard): self
    {
        if (!$this->MtgCards->contains($mtgCard)) {
            $this->MtgCards->add($mtgCard);
            $mtgCard->setMtgRarity($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->MtgCards->removeElement($mtgCard)) {
            // set the owning side to null (unless already changed)
            if ($mtgCard->getMtgRarity() === $this) {
                $mtgCard->setMtgRarity(null);
            }
        }

        return $this;
    }
}
