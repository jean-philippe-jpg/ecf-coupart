<?php

namespace App\Entity;

use App\Repository\NoteRecettesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRecettesRepository::class)]
class NoteRecettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $recettes_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getRecettesId(): ?int
    {
        return $this->recettes_id;
    }

    public function setRecettesId(?int $recettes_id): static
    {
        $this->recettes_id = $recettes_id;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

        return $this;
    }
}
