<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Organisator\OrganisatorTask;
use App\Entity\Tchat\TchatConversation;
use App\Entity\Tchat\TchatMessage;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ["groups" => ["user:read:collection"]]
        ]
    ],
    itemOperations:[
        "get"
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    use CommunAttributesTrait;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(["tchatConversation:read:collection", "tchatMessages:read:collection", "user:read:collection"])]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $authToken = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $authTokenGenerationDate = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TchatMessage::class)]
    private Collection $tchatMessages;

    #[ORM\ManyToMany(targetEntity: TchatConversation::class, mappedBy: 'users')]
    private Collection $tchatConversations;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: OrganisatorTask::class)]
    private Collection $organisatorTasks;

    public function __construct()
    {
        $this->tchatMessages = new ArrayCollection();
        $this->tchatConversations = new ArrayCollection();
        $this->organisatorTasks = new ArrayCollection();
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    public function setAuthToken(?string $authToken): self
    {
        $this->authToken = $authToken;

        return $this;
    }

    public function getAuthTokenGenerationDate(): ?\DateTimeInterface
    {
        return $this->authTokenGenerationDate;
    }

    public function setAuthTokenGenerationDate(?\DateTimeInterface $authTokenGenerationDate): self
    {
        $this->authTokenGenerationDate = $authTokenGenerationDate;

        return $this;
    }

    /**
     * @return Collection<int, TchatMessages>
     */
    public function getTchatMessages(): Collection
    {
        return $this->tchatMessages;
    }

    public function addTchatMessage(TchatMessage $tchatMessage): self
    {
        if (!$this->tchatMessages->contains($tchatMessage)) {
            $this->tchatMessages->add($tchatMessage);
            $tchatMessage->setUser($this);
        }

        return $this;
    }

    public function removeTchatMessage(TchatMessage $tchatMessage): self
    {
        if ($this->tchatMessages->removeElement($tchatMessage)) {
            // set the owning side to null (unless already changed)
            if ($tchatMessage->getUser() === $this) {
                $tchatMessage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TchatConversation>
     */
    public function getTchatConversations(): Collection
    {
        return $this->tchatConversations;
    }

    public function addTchatConversation(TchatConversation $tchatConversation): self
    {
        if (!$this->tchatConversations->contains($tchatConversation)) {
            $this->tchatConversations->add($tchatConversation);
            $tchatConversation->addUser($this);
        }

        return $this;
    }

    public function removeTchatConversation(TchatConversation $tchatConversation): self
    {
        if ($this->tchatConversations->removeElement($tchatConversation)) {
            $tchatConversation->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, OrganisatorTask>
     */
    public function getOrganisatorTasks(): Collection
    {
        return $this->organisatorTasks;
    }

    public function addOrganisatorTask(OrganisatorTask $organisatorTask): self
    {
        if (!$this->organisatorTasks->contains($organisatorTask)) {
            $this->organisatorTasks->add($organisatorTask);
            $organisatorTask->setUser($this);
        }

        return $this;
    }

    public function removeOrganisatorTask(OrganisatorTask $organisatorTask): self
    {
        if ($this->organisatorTasks->removeElement($organisatorTask)) {
            // set the owning side to null (unless already changed)
            if ($organisatorTask->getUser() === $this) {
                $organisatorTask->setUser(null);
            }
        }

        return $this;
    }
}
