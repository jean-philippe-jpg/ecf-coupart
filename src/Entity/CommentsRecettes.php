<?php

namespace App\Entity;

use App\Repository\CommentsRecettesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRecettesRepository::class)]
class CommentsRecettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'CommentsRecettes')]
    private ?user $users = null;

    #[ORM\ManyToOne(inversedBy: 'commentaire')]
    private ?Recettes $recettes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getUsers(): ?user
    {
        return $this->users;
    }

    public function setUsers(?user $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getRecettes(): ?Recettes
    {
        return $this->recettes;
    }

    public function setRecettes(?Recettes $recettes): static
    {
        $this->recettes = $recettes;

        return $this;
    }
}
