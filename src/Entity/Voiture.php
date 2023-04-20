<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\DateType;
use App\Repository\VoitureRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



#[ORM\Entity(repositoryClass: VoitureRepository::class)]
#[UniqueEntity(fields: ['plaque'], message:'La voiture est déja enregistré')]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * Summary of plaque
     * @var string|null
     * @Assert\Regex(pattern="/[A-Z]{2}-[0-9]{3}-[A-Z]{2}/", message="Le format n'est pas bon")
     * @Assert\Length(min=8, max=10)
     */
    
    #[ORM\Column(length: 255, unique: true)]
    
    private ?string $plaque = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $carburant = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $finition = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $annee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaque(): ?string
    {
        return $this->plaque;
    }

    public function setPlaque(string $plaque): self
    {
        $this->plaque = $plaque;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

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

    public function getFinition(): ?string
    {
        return $this->finition;
    }

    public function setFinition(?string $finition): self
    {
        $this->finition = $finition;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

 

    



}
