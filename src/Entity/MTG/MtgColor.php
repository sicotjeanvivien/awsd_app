<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgColorRepository::class)]
#[ApiResource]
#[HasLifecycleCallbacks]
class MtgColor
{
   use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 50)]
    private $code;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\ManyToMany(targetEntity: MtgCard::class, mappedBy: 'mtgColors')]
    private $mtgCards;

    public function __construct()
    {
        $this->mtgCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $mtgCard->addMtgColor($this);
        }

        return $this;
    }

    public function removeMtgCard(MtgCard $mtgCard): self
    {
        if ($this->mtgCards->removeElement($mtgCard)) {
            $mtgCard->removeMtgColor($this);
        }

        return $this;
    }
}


// INSERT INTO `mtg_color` (`id`, `code`, `name`, `created`, `updated`) VALUES
// 	(1, 'W', 'White', '2022-03-18 10:28:19', '2022-03-18 10:28:19'),
// 	(2, 'U', 'Blue', '2022-03-18 10:28:19', '2022-03-18 10:28:19'),
// 	(3, 'B', 'Black', '2022-03-18 10:28:19', '2022-03-18 10:28:19'),
// 	(4, 'R', 'Red', '2022-03-18 10:28:19', '2022-03-18 10:28:19'),
// 	(5, 'G', 'Green', '2022-03-18 10:28:19', '2022-03-18 10:28:19');