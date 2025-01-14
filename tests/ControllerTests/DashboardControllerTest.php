<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Repository\RencontreRepository;
use App\Controller\DashboardController;
use App\Entity\User;

class DashboardControllerTest extends TestCase
{
    public function testUserPourcentageVictoryWithMatches()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $controller = $this->getMockBuilder(DashboardController::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $user = new User();

        // Mock de `getUser` pour retourner l'utilisateur
        $controller->method('getUser')->willReturn($user);

        // Simulation des données : 6 victoires et 4 défaites
        $rencontreRepository->method('AllVictoriesCurrentYear')->willReturn(6);
        $rencontreRepository->method('AllDefeatsCurrentYear')->willReturn(4);

        $result = $controller->userPourcentageVictory($rencontreRepository);
        $this->assertEquals(60.0, $result);
    }

    public function testUserPourcentageVictoryWithNoMatches()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $controller = $this->getMockBuilder(DashboardController::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $user = new User();

        // Mock de `getUser` pour retourner l'utilisateur
        $controller->method('getUser')->willReturn($user);

        // Simulation des données : aucun match joué
        $rencontreRepository->method('AllVictoriesCurrentYear')->willReturn(0);
        $rencontreRepository->method('AllDefeatsCurrentYear')->willReturn(0);

        $result = $controller->userPourcentageVictory($rencontreRepository);
        $this->assertEquals(0.0, $result);
    }

    public function testUserPourcentageVictoryWithOnlyVictories()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $controller = $this->getMockBuilder(DashboardController::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $user = new User();

        // Mock de `getUser` pour retourner l'utilisateur
        $controller->method('getUser')->willReturn($user);

        // Simulation des données : 10 victoires et 0 défaites
        $rencontreRepository->method('AllVictoriesCurrentYear')->willReturn(10);
        $rencontreRepository->method('AllDefeatsCurrentYear')->willReturn(0);

        $result = $controller->userPourcentageVictory($rencontreRepository);
        $this->assertEquals(100.0, $result);
    }

    public function testUserPourcentageVictoryWithOnlyDefeats()
    {
        $rencontreRepository = $this->createMock(RencontreRepository::class);
        $controller = $this->getMockBuilder(DashboardController::class)
            ->onlyMethods(['getUser'])
            ->getMock();

        $user = new User();

        // Mock de `getUser` pour retourner l'utilisateur
        $controller->method('getUser')->willReturn($user);

        // Simulation des données : 10 victoires et 0 défaites
        $rencontreRepository->method('AllVictoriesCurrentYear')->willReturn(0);
        $rencontreRepository->method('AllDefeatsCurrentYear')->willReturn(10);

        $result = $controller->userPourcentageVictory($rencontreRepository);
        $this->assertEquals(0.0, $result);
    }

}
