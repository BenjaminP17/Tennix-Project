<?php

namespace App\Tests;

use App\Entity\User;
use App\Entity\Rencontre;
use PHPUnit\Framework\TestCase;

class RencontreTest extends TestCase
{
    public function testGetAndSetCompetition(): void
    {
        $rencontre = new Rencontre();
        $competition = 'Coupe du Monde';

        $rencontre->setCompetition($competition);
        $this->assertEquals($competition, $rencontre->getCompetition());
    }

    public function testGetAndSetAdversaire(): void
    {
        $rencontre = new Rencontre();
        $adversaire = 'Equipe B';

        $rencontre->setAdversaire($adversaire);
        $this->assertEquals($adversaire, $rencontre->getAdversaire());
    }

    public function testGetAndSetType(): void
    {
        $rencontre = new Rencontre();
        $type = 'Finale';

        $rencontre->setType($type);
        $this->assertEquals($type, $rencontre->getType());
    }

    public function testGetAndSetResultat(): void
    {
        $rencontre = new Rencontre();
        $resultat = 'Victoire';

        $rencontre->setResultat($resultat);
        $this->assertEquals($resultat, $rencontre->getResultat());
    }

    public function testGetAndSetScore(): void
    {
        $rencontre = new Rencontre();
        $score = '3-1';

        $rencontre->setScore($score);
        $this->assertEquals($score, $rencontre->getScore());
    }

    public function testGetAndSetDate(): void
    {
        $rencontre = new Rencontre();
        $date = new \DateTime('2024-08-20');

        $rencontre->setDate($date);
        $this->assertEquals($date, $rencontre->getDate());
    }

    public function testGetAndSetUser(): void
    {
        $rencontre = new Rencontre();
        $user = new User();

        $rencontre->setUser($user);
        $this->assertEquals($user, $rencontre->getUser());
    }

    public function testGetAndSetClassement(): void
    {
        $rencontre = new Rencontre();
        $classement = 'A';

        $rencontre->setClassement($classement);
        $this->assertEquals($classement, $rencontre->getClassement());
    }

    public function testGetAndSetSaison(): void
    {
        $rencontre = new Rencontre();
        $saison = '2023-2024';

        $rencontre->setSaison($saison);
        $this->assertEquals($saison, $rencontre->getSaison());
    }
}
