<?php

namespace App\Entity;

use App\Repository\CheckListRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Length;


use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: CheckListRepository::class)]
class CheckList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * )
     */
    private ?string $categoryName = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Zadanie do wykonania powinno składać się z conajmniej {{ limit }} znaków.",
     *      maxMessage = "Zadanie do wykonania powinno składać się z maksymalnie {{ limit }} znaków."
     * )
     */
    private ?string $Task = null;

    #[ORM\Column(nullable: false,
    options: ["default" => 0])]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'checkLists')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getTask(): ?string
    {
        return $this->Task;
    }

    public function setTask(string $Task): self
    {
        $this->Task = $Task;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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


}
