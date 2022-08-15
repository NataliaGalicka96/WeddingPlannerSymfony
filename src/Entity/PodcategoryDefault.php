<?php

namespace App\Entity;

use App\Repository\PodcategoryDefaultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PodcategoryDefaultRepository::class)]
class PodcategoryDefault
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'podcategoryDefaults')]
    private ?CheckListCategory $categoryName = null;

    #[ORM\Column(length: 255)]
    private ?string $podcategoryName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?CheckListCategory
    {
        return $this->categoryName;
    }

    public function setCategoryName(?CheckListCategory $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getPodcategoryName(): ?string
    {
        return $this->podcategoryName;
    }

    public function setPodcategoryName(string $podcategoryName): self
    {
        $this->podcategoryName = $podcategoryName;

        return $this;
    }
}
