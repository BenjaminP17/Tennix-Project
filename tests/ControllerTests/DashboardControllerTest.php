<?php

namespace App\Tests\ControllerTests;

use App\Controller\DashboardController;
use App\Repository\RencontreRepository;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class DashboardControllerTest extends TestCase
{
    public function testUserPourcentageVictoryWithVictoriesAndDefeats()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $user = new User();

        $rencontreRepository->method('findBy')
            ->willReturnOnConsecutiveCalls(
                array_fill(0, 5, 'Victoire'),  // 5 victoires
                array_fill(0, 5, 'Défaite')    // 5 défaites
            );

        $controller = new DashboardController();
        $result = $controller->userPourcentageVictory($rencontreRepository, $user);

        $this->assertEquals(50.0, $result);
    }

    public function testUserPourcentageVictoryWithOnlyVictories()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $user = new User();

        $rencontreRepository->method('findBy')
            ->willReturnOnConsecutiveCalls(
                array_fill(0, 10, 'Victoire'),  // 10 victoires
                []
            );

        $controller = new DashboardController();
        $result = $controller->userPourcentageVictory($rencontreRepository, $user);

        $this->assertEquals(100.0, $result);
    }

    public function testUserPourcentageVictoryWithOnlyDefeats()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $user = new User();

        $rencontreRepository->method('findBy')
            ->willReturnOnConsecutiveCalls(
                [],
                array_fill(0, 10, 'Défaite')  // 10 défaites
            );

        $controller = new DashboardController();
        $result = $controller->userPourcentageVictory($rencontreRepository, $user);

        $this->assertEquals(0.0, $result);
    }

    public function testUserPourcentageVictoryWithNoMatches()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $user = new User();

        $rencontreRepository->method('findBy')
            ->willReturnOnConsecutiveCalls(
                [],
                []
            );

        $controller = new DashboardController();
        $result = $controller->userPourcentageVictory($rencontreRepository, $user);

        $this->assertEquals(0.0, $result);
    }
}

