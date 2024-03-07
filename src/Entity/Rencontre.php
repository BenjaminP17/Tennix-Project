<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $compétition = null;

    #[ORM\Column(length: 255)]
    private ?string $Adversaire = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    #[ORM\Column(length: 255)]
    private ?string $Résultat = null;

    #[ORM\Column(length: 255)]
    private ?string $Score = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'rencontre')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompétition(): ?string
    {
        return $this->compétition;
    }

    public function setCompétition(string $compétition): static
    {
        $this->compétition = $compétition;

        return $this;
    }

    public function getAdversaire(): ?string
    {
        return $this->Adversaire;
    }

    public function setAdversaire(string $Adversaire): static
    {
        $this->Adversaire = $Adversaire;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getRésultat(): ?string
    {
        return $this->Résultat;
    }

    public function setRésultat(string $Résultat): static
    {
        $this->Résultat = $Résultat;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->Score;
    }

    public function setScore(string $Score): static
    {
        $this->Score = $Score;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
