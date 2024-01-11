<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['useraname'], message: 'There is already an account with this useraname')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $useraname = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    ##[Assert\Null]
    private ?string $allergenes ;

    #[ORM\Column(length: 255)]
    ##[Assert\Null]
    private ?string $regime ;

    #[ORM\ManyToMany(targetEntity: Recettes::class, inversedBy: 'users')]
    ##[JoinTable(name: 'user_recettes')]
    private Collection $recettes;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: CommentsRecettes::class)]
    private Collection $commentsRecettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->commentsRecettes = new ArrayCollection();
    }


    public function __toString()

{

    return $this->getUseraname().' '.$this->getPrenom();
       
    
}
    public function getId(): ?int
    {
        return $this->id;

    }


    #public function __CONSTRUCT(){

        #$this->createdAt = new \DateTimeImmutable();

   #}

    public function getUseraname(): ?string
    {
        return $this->useraname;
    }

    public function setUseraname(string $useraname): static
    {
        $this->useraname = $useraname;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->useraname;
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAllergenes(): ?string
    {
        return $this->allergenes;
    }

    public function setAllergenes(string $allergenes): static
    {
        $this->allergenes = $allergenes;

        return $this;
    }

    public function getRegime(): ?string
    {
        return $this->regime;
    }

    public function setRegime(string $regime): static
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * @return Collection<int, recettes>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(recettes $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
        }

        return $this;
    }

    public function removeRecette(recettes $recette): static
    {
        $this->recettes->removeElement($recette);

        return $this;
    }

    /**
     * @return Collection<int, CommentsRecettes>
     */
    public function getCommentsRecettes(): Collection
    {
        return $this->commentsRecettes;
    }

    public function addCommentsRecette(CommentsRecettes $commentsRecette): static
    {
        if (!$this->commentsRecettes->contains($commentsRecette)) {
            $this->commentsRecettes->add($commentsRecette);
            $commentsRecette->setUsers($this);
        }

        return $this;
    }

    public function removeCommentsRecette(CommentsRecettes $commentsRecette): static
    {
        if ($this->commentsRecettes->removeElement($commentsRecette)) {
            // set the owning side to null (unless already changed)
            if ($commentsRecette->getUsers() === $this) {
                $commentsRecette->setUsers(null);
            }
        }

        return $this;
    }
}
