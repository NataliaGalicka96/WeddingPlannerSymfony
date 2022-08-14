<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Guest::class)]
    private Collection $guests;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Contact::class)]
    private Collection $contact;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CheckListAssignedToUser::class)]
    private Collection $checkListAssignedToUsers;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CheckCategoryAssignedToUser::class)]
    private Collection $checkCategoryAssignedToUsers;


    public function __construct()
    {
        $this->guests = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->checkListAssignedToUsers = new ArrayCollection();
        $this->checkCategoryAssignedToUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Guest>
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(Guest $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests->add($guest);
            $guest->setUser($this);
        }

        return $this;
    }

    public function removeGuest(Guest $guest): self
    {
        if ($this->guests->removeElement($guest)) {
            // set the owning side to null (unless already changed)
            if ($guest->getUser() === $this) {
                $guest->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CheckListAssignedToUser>
     */
    public function getCheckListAssignedToUsers(): Collection
    {
        return $this->checkListAssignedToUsers;
    }

    public function addCheckListAssignedToUser(CheckListAssignedToUser $checkListAssignedToUser): self
    {
        if (!$this->checkListAssignedToUsers->contains($checkListAssignedToUser)) {
            $this->checkListAssignedToUsers->add($checkListAssignedToUser);
            $checkListAssignedToUser->setUser($this);
        }

        return $this;
    }

    public function removeCheckListAssignedToUser(CheckListAssignedToUser $checkListAssignedToUser): self
    {
        if ($this->checkListAssignedToUsers->removeElement($checkListAssignedToUser)) {
            // set the owning side to null (unless already changed)
            if ($checkListAssignedToUser->getUser() === $this) {
                $checkListAssignedToUser->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CheckCategoryAssignedToUser>
     */
    public function getCheckCategoryAssignedToUsers(): Collection
    {
        return $this->checkCategoryAssignedToUsers;
    }

    public function addCheckCategoryAssignedToUser(CheckCategoryAssignedToUser $checkCategoryAssignedToUser): self
    {
        if (!$this->checkCategoryAssignedToUsers->contains($checkCategoryAssignedToUser)) {
            $this->checkCategoryAssignedToUsers->add($checkCategoryAssignedToUser);
            $checkCategoryAssignedToUser->setUser($this);
        }

        return $this;
    }

    public function removeCheckCategoryAssignedToUser(CheckCategoryAssignedToUser $checkCategoryAssignedToUser): self
    {
        if ($this->checkCategoryAssignedToUsers->removeElement($checkCategoryAssignedToUser)) {
            // set the owning side to null (unless already changed)
            if ($checkCategoryAssignedToUser->getUser() === $this) {
                $checkCategoryAssignedToUser->setUser(null);
            }
        }

        return $this;
    }


}
