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

    #[ORM\OneToMany(mappedBy: 'weddingSettings', targetEntity: User::class)]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setWeddingSettings($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getWeddingSettings() === $this) {
                $user->setWeddingSettings(null);
            }
        }

        return $this;
    }
}
