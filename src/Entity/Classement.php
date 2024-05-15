<?php

namespace App\Entity;

use App\Repository\ClassementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassementRepository::class)]
class Classement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classJanv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classFev = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classMar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classAvr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classMai = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classJui = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classJuil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classAout = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classSept = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classOct = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classNov = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $classDec = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $saison = null;

    #[ORM\ManyToOne(inversedBy: 'classement')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassJanv(): ?int
    {
        return $this->classJanv;
    }

    public function setClassJanv(?int $classJanv): static
    {
        $this->classJanv = $classJanv;

        return $this;
    }

    public function getClassFev(): ?int
    {
        return $this->classFev;
    }

    public function setClassFev(?int $classFev): static
    {
        $this->classFev = $classFev;

        return $this;
    }

    public function getClassMar(): ?int
    {
        return $this->classMar;
    }

    public function setClassMar(?int $classMar): static
    {
        $this->classMar = $classMar;

        return $this;
    }

    public function getClassAvr(): ?int
    {
        return $this->classAvr;
    }

    public function setClassAvr(?int $classAvr): static
    {
        $this->classAvr = $classAvr;

        return $this;
    }

    public function getClassMai(): ?int
    {
        return $this->classMai;
    }

    public function setClassMai(?int $classMai): static
    {
        $this->classMai = $classMai;

        return $this;
    }

    public function getClassJui(): ?int
    {
        return $this->classJui;
    }

    public function setClassJui(?int $classJui): static
    {
        $this->classJui = $classJui;

        return $this;
    }

    public function getClassJuil(): ?int
    {
        return $this->classJuil;
    }

    public function setClassJuil(?int $classJuil): static
    {
        $this->classJuil = $classJuil;

        return $this;
    }

    public function getClassAout(): ?int
    {
        return $this->classAout;
    }

    public function setClassAout(?int $classAout): static
    {
        $this->classAout = $classAout;

        return $this;
    }

    public function getClassSept(): ?int
    {
        return $this->classSept;
    }

    public function setClassSept(?int $classSept): static
    {
        $this->classSept = $classSept;

        return $this;
    }

    public function getClassOct(): ?int
    {
        return $this->classOct;
    }

    public function setClassOct(?int $classOct): static
    {
        $this->classOct = $classOct;

        return $this;
    }

    public function getClassNov(): ?int
    {
        return $this->classNov;
    }

    public function setClassNov(?int $classNov): static
    {
        $this->classNov = $classNov;

        return $this;
    }

    public function getClassDec(): ?int
    {
        return $this->classDec;
    }

    public function setClassDec(?int $classDec): static
    {
        $this->classDec = $classDec;

        return $this;
    }

    public function getSaison(): ?string
    {
        return $this->saison;
    }

    public function setSaison(?string $saison): static
    {
        $this->saison = $saison;

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
