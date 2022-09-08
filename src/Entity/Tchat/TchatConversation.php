<?php

namespace App\Entity\Tchat;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\CommunAttributesTrait;
use App\Entity\User;
use App\Repository\Tchat\TchatConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TchatConversationRepository::class)]
#[HasLifecycleCallbacks]
#[
    ApiResource(
        attributes: ["security" => "is_granted('ROLE_USER')"],
        collectionOperations: [
            "get" => [
                'normalization_context' => ["groups" => ["tchatConversation:read:collection"]]
            ],
            "post"
        ],
        itemOperations: [
            "get"
        ]
    ),
    ApiFilter(SearchFilter::class, properties: ['id' => 'exact', "users.username" => "exact"])
]
class TchatConversation
{

    use CommunAttributesTrait;

    #[ORM\OneToMany(mappedBy: 'tchatConversation', targetEntity: TchatMessage::class)]
    private Collection $messages;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'tchatConversations')]
    #[Groups(["tchatConversation:read:collection"])]
    private Collection $users;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection<int, TchatMessages>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(TchatMessage $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setTchatConversation($this);
        }

        return $this;
    }

    public function removeMessage(TchatMessage $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getTchatConversation() === $this) {
                $message->setTchatConversation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }
}
