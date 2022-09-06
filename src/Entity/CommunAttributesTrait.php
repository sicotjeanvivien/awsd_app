<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait CommunAttributesTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups([
        "mtgCard:read:collection", "mtgCard:read:item",
        "tchatConversation:read:collection"
        ])]
    private $id;

    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(
        type: 'datetime',
        columnDefinition: "DATETIME on update CURRENT_TIMESTAMP",
    )]
    protected $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }


    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $now = new DateTime("now");
        $this->created = $now;
        $this->updated = $now;
    }
    
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updated = new DateTime("now");
    }
}