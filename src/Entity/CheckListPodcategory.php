<?php

namespace App\Entity;

use App\Repository\CheckListPodcategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckListPodcategoryRepository::class)]
class CheckListPodcategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'checkListPodcategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CheckListCategory $category = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?CheckListCategory
    {
        return $this->category;
    }

    public function setCategory(?CheckListCategory $category): self
    {
        $this->category = $category;

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
}
