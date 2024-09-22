<?php

namespace App\Tests\EntityTests;

use App\Entity\Tournament;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TournamentTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $tournament = new Tournament();

        // Test des getters et setters pour chaque propriété
        $this->assertNull($tournament->getId());

        $tournament->setName('Championship');
        $this->assertEquals('Championship', $tournament->getName());

        $date = new \DateTime('2024-08-20');
        $tournament->setDate($date);
        $this->assertEquals($date, $tournament->getDate());

        $tournament->setType('Open');
        $this->assertEquals('Open', $tournament->getType());

        $tournament->setSaison('2024');
        $this->assertEquals('2024', $tournament->getSaison());

        $user = new User();
        $tournament->setUser($user);
        $this->assertSame($user, $tournament->getUser());

        $echeance = new \DateTime('2024-12-31');
        $tournament->setEcheance($echeance);
        $this->assertEquals($echeance, $tournament->getEcheance());
    }
}
