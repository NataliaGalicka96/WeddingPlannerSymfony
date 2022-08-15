<?php

namespace App\Entity;

use App\Repository\CheckListCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckListCategoryRepository::class)]
class CheckListCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: CheckListPodcategory::class)]
    private Collection $checkListPodcategories;



    public function __construct()
    {
        $this->checkListPodcategories = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, CheckListPodcategory>
     */
    public function getCheckListPodcategories(): Collection
    {
        return $this->checkListPodcategories;
    }

    public function addCheckListPodcategory(CheckListPodcategory $checkListPodcategory): self
    {
        if (!$this->checkListPodcategories->contains($checkListPodcategory)) {
            $this->checkListPodcategories->add($checkListPodcategory);
            $checkListPodcategory->setCategory($this);
        }

        return $this;
    }

    public function removeCheckListPodcategory(CheckListPodcategory $checkListPodcategory): self
    {
        if ($this->checkListPodcategories->removeElement($checkListPodcategory)) {
            // set the owning side to null (unless already changed)
            if ($checkListPodcategory->getCategory() === $this) {
                $checkListPodcategory->setCategory(null);
            }
        }

        return $this;
    }

    
}
