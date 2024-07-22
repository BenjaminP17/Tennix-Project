<?php

namespace App\Tests;

use App\Entity\Rencontre;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RencontreTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $rencontre = new Rencontre();
        $rencontre->setCompetition('Tournoi Open')
            ->setAdversaire('Pete Sampras')
            ->setResultat('Défaite')
            ->setType('Simple')
            ->setScore('6/0 6/0');
            

        $errors = $container->get('validator')->validate($rencontre);

        $this->assertCount(0, $errors);
    }
}
