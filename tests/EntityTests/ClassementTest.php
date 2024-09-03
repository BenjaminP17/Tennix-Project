<?php

namespace App\Tests\EntityTests;

use App\Entity\Classement;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ClassementTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $classement = new Classement();

        // Test des getters et setters pour chaque propriété
        $this->assertNull($classement->getId());

        $classement->setClassJanv(1);
        $this->assertEquals(1, $classement->getClassJanv());

        $classement->setClassFev(2);
        $this->assertEquals(2, $classement->getClassFev());

        $classement->setClassMar(3);
        $this->assertEquals(3, $classement->getClassMar());

        $classement->setClassAvr(4);
        $this->assertEquals(4, $classement->getClassAvr());

        $classement->setClassMai(5);
        $this->assertEquals(5, $classement->getClassMai());

        $classement->setClassJui(6);
        $this->assertEquals(6, $classement->getClassJui());

        $classement->setClassJuil(7);
        $this->assertEquals(7, $classement->getClassJuil());

        $classement->setClassAout(8);
        $this->assertEquals(8, $classement->getClassAout());

        $classement->setClassSept(9);
        $this->assertEquals(9, $classement->getClassSept());

        $classement->setClassOct(10);
        $this->assertEquals(10, $classement->getClassOct());

        $classement->setClassNov(11);
        $this->assertEquals(11, $classement->getClassNov());

        $classement->setClassDec(12);
        $this->assertEquals(12, $classement->getClassDec());

        $classement->setSaison('2024');
        $this->assertEquals('2024', $classement->getSaison());

        $user = new User();
        $classement->setUser($user);
        $this->assertSame($user, $classement->getUser());
    }
}
