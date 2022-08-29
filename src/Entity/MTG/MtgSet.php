<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgSetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MtgSetRepository::class)]
#[ApiResource(
    paginationEnabled: false,
    collectionOperations: [
        "get" => ['normalization_context' => ["groups" => ["mtgSet:read:collection"]]]
    ],
    itemOperations: [
        "get"
    ]
)]
#[HasLifecycleCallbacks]
class MtgSet
{
    use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 25)]
    #[Groups(["mtgSet:read:collection"])]
    private $code;
    
    #[ORM\Column(type: 'string', length: 150)]
    #[Groups(["mtgCard:read:item", "mtgSet:read:collection"])]
    private $name;
    
    #[ORM\Column(type: 'date')]
    #[Groups(["mtgSet:read:collection"])]
    private $releaseDate;
    
    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(["mtgSet:read:collection"])]
    private $onlineOnly;

    #[ORM\OneToMany(mappedBy: 'mtgSet', targetEntity: MtgCard::class)]
    private $mtgCards;

    public function __construct()
    {
        $this->mtgCards = new ArrayCollection();
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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getOnlineOnly(): ?bool
    {
        return $this->onlineOnly;
    }

    public function setOnlineOnly(?bool $onlineOnly): self
    {
        $this->onlineOnly = $onlineOnly;

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
            $mtgCard->setMtgSet($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->mtgCards->removeElement($mtgCard)) {
            // set the owning side to null (unless already changed)
            if ($mtgCard->getMtgSet() === $this) {
                $mtgCard->setMtgSet(null);
            }
        }

        return $this;
    }
}
