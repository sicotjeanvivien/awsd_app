<?php

namespace App\Entity\Tchat;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\CommunAttributesTrait;
use App\Entity\User;
use App\Repository\Tchat\TchatMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TchatMessageRepository::class)]
#[HasLifecycleCallbacks]
#[
    ApiResource(
        attributes: ["security" => "is_granted('ROLE_USER')"],
        collectionOperations: [
            "get" => [
                'normalization_context' => ["groups" => ["tchatMessages:read:collection"]]
            ],
            "post"
        ],
    ),
    ApiFilter(SearchFilter::class,  properties: ['id' => 'exact', "tchatConversation.id" => "exact"])
]
class TchatMessage
{

    use CommunAttributesTrait;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["tchatMessages:read:collection"])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'tchatMessages')]
    #[Groups(["tchatMessages:read:collection"])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?TchatConversation $tchatConversation = null;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTchatConversation(): ?TchatConversation
    {
        return $this->tchatConversation;
    }

    public function setTchatConversation(?TchatConversation $tchatConversation): self
    {
        $this->tchatConversation = $tchatConversation;

        return $this;
    }
}
