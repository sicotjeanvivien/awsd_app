<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Entity\MTG\MtgColor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: ManaCostRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: [
        "get"
    ],
    itemOperations: [
        "get"
    ]
)]
class MtgManaCost
{

    use CommunAttributesTrait;

    #[ORM\Column]
    private ?int $cost = null;

    #[ORM\ManyToOne(inversedBy: 'mtgManaCosts')]
    private ?MtgColor $color = null;

    #[ORM\ManyToMany(targetEntity: MtgCard::class, mappedBy: 'mtgManaCosts')]
    private Collection $mtgCards;

    public function __construct()
    {
        $this->mtgCards = new ArrayCollection();
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getColor(): ?MtgColor
    {
        return $this->color;
    }

    public function setColor(?MtgColor $color): self
    {
        $this->color = $color;

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
            $this->mtgCards->add($mtgCard);
            $mtgCard->addMtgManaCost($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->mtgCards->removeElement($mtgCard)) {
            $mtgCard->removeMtgManaCost($this);
        }

        return $this;
    }
}
