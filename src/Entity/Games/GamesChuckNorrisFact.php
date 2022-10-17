<?php

namespace App\Entity\Games;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\API\ChuckNorrisFactController;
use App\Entity\CommunAttributesTrait;
use App\Repository\Games\GamesChuckNorrisFactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: GamesChuckNorrisFactRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: [
        "get",
        "post",
        "random" => [
            "method" => "GET",
            "path" => "/chuck_norris_fact/random",
            "controller" => ChuckNorrisFactController::class
        ]
    ],
    itemOperations: [
        "get",
        "putCustom" => [
            "name" => "putCustom",
            "method" => "PUT",
            "path" => "/chuck_norris_fact/putCustom",
            "controller" => ChuckNorrisFactController::class
        ]
    ],

)]
class GamesChuckNorrisFact
{

    use CommunAttributesTrait;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $fact = null;

    #[ORM\Column(nullable: true, options: ['default' => 0])]
    private ?int $liked = null;

    #[ORM\Column(nullable: true, options: ['default' => 0])]
    private ?int $disliked = null;

    #[ORM\Column(nullable: true, options: ['default' => false])]
    private ?bool $isValided = null;

    public function getFact(): ?string
    {
        return $this->fact;
    }

    public function setFact(string $fact): self
    {
        $this->fact = $fact;

        return $this;
    }

    public function getLiked(): ?int
    {
        return $this->liked;
    }

    public function setLiked(?int $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function getDisliked(): ?int
    {
        return $this->disliked;
    }

    public function setDisliked(?int $disliked): self
    {
        $this->disliked = $disliked;

        return $this;
    }

    public function isIsValided(): ?bool
    {
        return $this->isValided;
    }

    public function setIsValided(?bool $isValided): self
    {
        $this->isValided = $isValided;

        return $this;
    }
}
