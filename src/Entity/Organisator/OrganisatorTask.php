<?php

namespace App\Entity\Organisator;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\API\OrganisatorTaskController;
use App\Entity\CommunAttributesTrait;
use App\Entity\User;
use App\Repository\Organisator\OrganisatorTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: OrganisatorTaskRepository::class)]
#[HasLifecycleCallbacks]
#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_USER')"],
    collectionOperations: [
        "collection" => [
            "method" => "GET",
            "path" => "/organisator_tasks/custom",
            "controller" => OrganisatorTaskController::class
        ],
        "post"
    ],
    itemOperations: [
        "get" => ["security" => "is_granted('ROLE_USER') and object.user == user"],
        "put",
        "patch",
        "delete"
    ]
)]
class OrganisatorTask
{

    use CommunAttributesTrait;

    #[ORM\Column(length: 255)]
    private ?string $task = null;

    #[ORM\Column]
    private ?int $weekNumber = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(options: ["default" => false])]
    private ?bool $making = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'organisatorTasks')]
    public ?User $user = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'tasks')]
    private ?self $organisatorTask = null;

    #[ORM\OneToMany(mappedBy: 'organisatorTask', targetEntity: self::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getWeekNumber(): ?int
    {
        return $this->weekNumber;
    }

    public function setWeekNumber(int $weekNumber): self
    {
        $this->weekNumber = $weekNumber;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isMaking(): ?bool
    {
        return $this->making;
    }

    public function setMaking(bool $making): self
    {
        $this->making = $making;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getOrganisatorTask(): ?self
    {
        return $this->organisatorTask;
    }

    public function setOrganisatorTask(?self $organisatorTask): self
    {
        $this->organisatorTask = $organisatorTask;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(self $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setOrganisatorTask($this);
        }

        return $this;
    }

    public function removeTask(self $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getOrganisatorTask() === $this) {
                $task->setOrganisatorTask(null);
            }
        }

        return $this;
    }
}
