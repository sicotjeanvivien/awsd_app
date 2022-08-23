<?php

namespace App\Entity\MTG;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\CommunAttributesTrait;
use App\Repository\MTG\MtgCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: MtgCardRepository::class)]
#[
    ApiResource(paginationEnabled:true, paginationItemsPerPage:30),
    ApiFilter(SearchFilter::class, properties: ['id'=> 'exact', "mtgSet.code" => "exact"])
]
#[HasLifecycleCallbacks]
class MtgCard
{
    use CommunAttributesTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: MtgType::class, inversedBy: 'mtgCards')]
    private $mtgTypes;

    #[ORM\ManyToOne(targetEntity: MtgSet::class, inversedBy: 'mtgCards')]
    private $mtgSet;

    #[ORM\ManyToMany(targetEntity: MtgSubtype::class, inversedBy: 'mtgCards')]
    private $mtgSubtypes;

    #[ORM\ManyToMany(targetEntity: MtgSupertype::class, inversedBy: 'mtgCards')]
    private $SuperTypes;

    #[ORM\ManyToMany(targetEntity: MtgManaCost::class, inversedBy: 'mtgCards')]
    private Collection $mtgManaCosts;

    #[ORM\ManyToOne(inversedBy: 'MtgCards')]
    private ?MtgRarity $mtgRarity = null;

    #[ORM\ManyToOne(inversedBy: 'mtgCards')]
    private ?MtgArtist $mtgArtist = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $number = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $power = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $toughness = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $multiverseid = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $foreignTexts = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    public function __construct()
    {
        $this->mtgTypes = new ArrayCollection();
        $this->mtgSubtypes = new ArrayCollection();
        $this->SuperTypes = new ArrayCollection();
        $this->mtgManaCosts = new ArrayCollection();
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

    /**
     * @return Collection<int, MtgManaCost>
     */
    public function getMtgManaCosts(): Collection
    {
        return $this->mtgManaCosts;
    }

    public function addMtgManaCost(MtgManaCost $mtgManaCost): self
    {
        if (!$this->mtgManaCosts->contains($mtgManaCost)) {
            $this->mtgManaCosts->add($mtgManaCost);
        }

        return $this;
    }

    public function removeMtgManaCost(MtgManaCost $mtgManaCost): self
    {
        $this->mtgManaCosts->removeElement($mtgManaCost);

        return $this;
    }

    public function getMtgRarity(): ?MtgRarity
    {
        return $this->mtgRarity;
    }

    public function setMtgRarity(?MtgRarity $mtgRarity): self
    {
        $this->mtgRarity = $mtgRarity;

        return $this;
    }

    public function getMtgArtist(): ?MtgArtist
    {
        return $this->mtgArtist;
    }

    public function setMtgArtist(?MtgArtist $mtgArtist): self
    {
        $this->mtgArtist = $mtgArtist;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(?string $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getToughness(): ?string
    {
        return $this->toughness;
    }

    public function setToughness(?string $toughness): self
    {
        $this->toughness = $toughness;

        return $this;
    }

    public function getMultiverseid(): ?string
    {
        return $this->multiverseid;
    }

    public function setMultiverseid(?string $multiverseid): self
    {
        $this->multiverseid = $multiverseid;

        return $this;
    }

    public function getForeignTexts(): ?string
    {
        return $this->foreignTexts;
    }

    public function setForeignTexts(?string $foreignTexts): self
    {
        $this->foreignTexts = $foreignTexts;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
