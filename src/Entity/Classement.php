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
    private ?string $classJanv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classFev = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classMar = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classAvr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classMai = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classJui = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classJuil = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classAout = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classSept = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classOct = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classNov = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $classDec = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $saison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassJanv(): ?string
    {
        return $this->classJanv;
    }

    public function setClassJanv(?string $classJanv): static
    {
        $this->classJanv = $classJanv;

        return $this;
    }

    public function getClassFev(): ?string
    {
        return $this->classFev;
    }

    public function setClassFev(?string $classFev): static
    {
        $this->classFev = $classFev;

        return $this;
    }

    public function getClassMar(): ?string
    {
        return $this->classMar;
    }

    public function setClassMar(?string $classMar): static
    {
        $this->classMar = $classMar;

        return $this;
    }

    public function getClassAvr(): ?string
    {
        return $this->classAvr;
    }

    public function setClassAvr(?string $classAvr): static
    {
        $this->classAvr = $classAvr;

        return $this;
    }

    public function getClassMai(): ?string
    {
        return $this->classMai;
    }

    public function setClassMai(?string $classMai): static
    {
        $this->classMai = $classMai;

        return $this;
    }

    public function getClassJui(): ?string
    {
        return $this->classJui;
    }

    public function setClassJui(?string $classJui): static
    {
        $this->classJui = $classJui;

        return $this;
    }

    public function getClassJuil(): ?string
    {
        return $this->classJuil;
    }

    public function setClassJuil(?string $classJuil): static
    {
        $this->classJuil = $classJuil;

        return $this;
    }

    public function getClassAout(): ?string
    {
        return $this->classAout;
    }

    public function setClassAout(?string $classAout): static
    {
        $this->classAout = $classAout;

        return $this;
    }

    public function getClassSept(): ?string
    {
        return $this->classSept;
    }

    public function setClassSept(?string $classSept): static
    {
        $this->classSept = $classSept;

        return $this;
    }

    public function getClassOct(): ?string
    {
        return $this->classOct;
    }

    public function setClassOct(?string $classOct): static
    {
        $this->classOct = $classOct;

        return $this;
    }

    public function getClassNov(): ?string
    {
        return $this->classNov;
    }

    public function setClassNov(?string $classNov): static
    {
        $this->classNov = $classNov;

        return $this;
    }

    public function getClassDec(): ?string
    {
        return $this->classDec;
    }

    public function setClassDec(?string $classDec): static
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
}
