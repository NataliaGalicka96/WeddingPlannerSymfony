<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?User $user = null;

    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\Length(
     *      min = 6,
     *      max = 20,
     *      minMessage = "Tytuł powinien składać się z conajmniej {{ limit }} znaków.",
     *      maxMessage = "Tytuł powinien składać się z maksymalnie {{ limit }} znaków."
     * )
     */
    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    /**
     * @Assert\NotBlank(message="To pole jest wymagane.")
     * @Assert\Length(
     *      min = 10,
     *      max = 500,
     *      minMessage = "Notatka powinna składać się z conajmniej {{ limit }} znaków.",
     *      maxMessage = "Notatka powinna składać się z maksymalnie {{ limit }} znaków."
     * )
     */
    #[ORM\Column(length: 255)]
    private ?string $Note = null;

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

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $Note): self
    {
        $this->Note = $Note;

        return $this;
    }
}
