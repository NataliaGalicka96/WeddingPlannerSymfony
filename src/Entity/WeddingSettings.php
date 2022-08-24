<?php

namespace App\Entity;

use App\Repository\WeddingSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeddingSettingsRepository::class)]
class WeddingSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brideName = null;

    #[ORM\Column(length: 255)]
    private ?string $groomName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'weddingSettings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getBrideName(): ?string
    {
        return $this->brideName;
    }

    public function setBrideName(string $brideName): self
    {
        $this->brideName = $brideName;

        return $this;
    }

    public function getGroomName(): ?string
    {
        return $this->groomName;
    }

    public function setGroomName(string $groomName): self
    {
        $this->groomName = $groomName;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

   
}
