<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]

class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'guests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_confirmed = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_accommodation = null;

    #[ORM\Column(nullable: true)]
    private ?bool $transport = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_adult = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_child_under_3_years = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_child_between_3_12_years = null;

    #[ORM\Column(nullable: true)]
    private ?bool $special_diet = null;

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


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isIsConfirmed(): ?bool
    {
        return $this->is_confirmed;
    }

    public function setIsConfirmed(bool $is_confirmed): self
    {
        $this->is_confirmed = $is_confirmed;

        return $this;
    }

    public function isIsAccommodation(): ?bool
    {
        return $this->is_accommodation;
    }

    public function setIsAccommodation(?bool $is_accommodation): self
    {
        $this->is_accommodation = $is_accommodation;

        return $this;
    }

    public function isTransport(): ?bool
    {
        return $this->transport;
    }

    public function setTransport(?bool $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function isIsAdult(): ?bool
    {
        return $this->is_adult;
    }

    public function setIsAdult(?bool $is_adult): self
    {
        $this->is_adult = $is_adult;

        return $this;
    }

    public function isIsChildUnder3Years(): ?bool
    {
        return $this->is_child_under_3_years;
    }

    public function setIsChildUnder3Years(?bool $is_child_under_3_years): self
    {
        $this->is_child_under_3_years = $is_child_under_3_years;

        return $this;
    }

    public function isIsChildBetween312Years(): ?bool
    {
        return $this->is_child_between_3_12_years;
    }

    public function setIsChildBetween312Years(?bool $is_child_between_3_12_years): self
    {
        $this->is_child_between_3_12_years = $is_child_between_3_12_years;

        return $this;
    }

    public function isSpecialDiet(): ?bool
    {
        return $this->special_diet;
    }

    public function setSpecialDiet(?bool $special_diet): self
    {
        $this->special_diet = $special_diet;

        return $this;
    }
}
