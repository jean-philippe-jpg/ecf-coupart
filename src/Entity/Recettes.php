<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecettesRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;







#[ORM\Entity(repositoryClass: RecettesRepository::class)]
#[Vich\Uploadable]
class Recettes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $preparation = null;

    #[ORM\Column]
    private ?int $repos = null;

    #[ORM\Column]
    private ?int $cuisson = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredients = null;

    #[ORM\Column(length: 255)]
    private ?string $etapes = null;

    #[ORM\Column(length: 255)]
    private ?string $allergene = null;

    #[ORM\Column(length: 255)]
    private ?string $regime = null;

    #[Vich\UploadableField(mapping: 'recettes', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

   #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    
    #[ORM\Column(nullable: true)] 
    private ?\DateTimeImmutable $updatedAt = null;

    ##[ORM\ManyToOne(inversedBy: 'recettes')]
    #private ?\Patients $patients = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'recettes')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'recettes', targetEntity: CommentsRecettes::class)]
    private Collection $commentaire;

    #[ORM\ManyToMany(targetEntity: Allergenes::class, inversedBy: 'recettes')]
    private Collection $allergenes;

    #[ORM\ManyToMany(targetEntity: Regimes::class, inversedBy: 'recettes')]
    private Collection $regimes;

    
    public function __construct()
    {   
        $this->users = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
        $this->allergenes = new ArrayCollection();
        $this->regimes = new ArrayCollection();
    }

   

    public function __toString()
    {
         return $this->getTitre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPreparation(): ?int
    {
        return $this->preparation;
    }

    public function setPreparation(int $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getRepos(): ?int
    {
        return $this->repos;
    }

    public function setRepos(int $repos): static
    {
        $this->repos = $repos;

        return $this;
    }

    public function getCuisson(): ?int
    {
        return $this->cuisson;
    }

    public function setCuisson(int $cuisson): static
    {
        $this->cuisson = $cuisson;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getEtapes(): ?string
    {
        return $this->etapes;
    }

    public function setEtapes(string $etapes): static
    {
        $this->etapes = $etapes;

        return $this;
    }

    public function getAllergene(): ?string
    {
        return $this->allergene;
    }

    public function setAllergene(string $allergene): static
    {
        $this->allergene = $allergene;

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

   
   # public function getPatients(): ?Patients
    #{
        #return $this->patients;
    #}

   # public function setPatients(?Patients $patients): static
    #{
        #$this->patients = $patients;

       # return $this;
    #}

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRecette($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeRecette($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, commentsRecettes>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(commentsRecettes $commentaire): static
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
            $commentaire->setRecettes($this);
        }

        return $this;
    }

    public function removeCommentaire(commentsRecettes $commentaire): static
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getRecettes() === $this) {
                $commentaire->setRecettes(null);
            }
        }

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
     {
      $this->imageFile = $imageFile;

      if (null !== $imageFile) {
           //It is required that at least one field changes if you are using doctrine
           //otherwise the event listeners won't be called and the file is lost
          $this->updatedAt = new \DateTimeImmutable();
      
      
      }
    }
   
    public function getUpdatedAt() 
    {
        return $this->updatedAt;
    }
  
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

  public function getImageFile(): ?File
  {
      return $this->imageFile;
  }

  public function setImageName(?string $imageName): void
  {
      $this->imageName = $imageName;
  }

  public function getImageName(): ?string
    {
      return $this->imageName;
  }

  public function setImageSize(?int $imageSize): void
   {
      $this->imageSize = $imageSize;
   }

   public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

   /**
    * @return Collection<int, allergenes>
    */
   public function getAllergenes(): Collection
   {
       return $this->allergenes;
   }

   public function addAllergene(allergenes $allergene): static
   {
       if (!$this->allergenes->contains($allergene)) {
           $this->allergenes->add($allergene);
       }

       return $this;
   }

   public function removeAllergene(allergenes $allergene): static
   {
       $this->allergenes->removeElement($allergene);

       return $this;
   }

   /**
    * @return Collection<int, regimes>
    */
   public function getRegimes(): Collection
   {
       return $this->regimes;
   }

   public function addRegime(regimes $regime): static
   {
       if (!$this->regimes->contains($regime)) {
           $this->regimes->add($regime);
       }

       return $this;
   }

   public function removeRegime(regimes $regime): static
   {
       $this->regimes->removeElement($regime);

       return $this;
   }
      
    
   
}
