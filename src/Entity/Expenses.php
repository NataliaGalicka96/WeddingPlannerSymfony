<?php

namespace App\Entity;

use App\Repository\ExpensesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExpensesRepository::class)]
class Expenses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $category_name = null;
     /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Nazwa wydatku powinna składać się z conajmniej {{ limit }} znaków.",
     *      maxMessage = "Nazwa wydatku powinna składać się z maksymalnie {{ limit }} znaków."
     * )
     */
    #[ORM\Column(length: 255)]
    private ?string $expense = null;
    
    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\PositiveOrZero (message="Proszę podać liczbę dodatnią.")
     * @Assert\LessThan(10000000)(message="Wartość musi być mniejsza niż {{compared_value}} zł.)
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: false,
    options: ["default" => 0.00])]
    private ?string $Price = null;


    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\PositiveOrZero (message="Proszę podać liczbę dodatnią.")
     * @Assert\LessThan(10000000)(message="Wartość musi być mniejsza niż {{compared_value}} zł.)
     */
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: false,
    options: ["default" => 0.00])]
    private ?string $already_paid = null;

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

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getExpense(): ?string
    {
        return $this->expense;
    }

    public function setExpense(string $expense): self
    {
        $this->expense = $expense;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(?string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getAlreadyPaid(): ?string
    {
        return $this->already_paid;
    }

    public function setAlreadyPaid(?string $already_paid): self
    {
        $this->already_paid = $already_paid;

        return $this;
    }
}
