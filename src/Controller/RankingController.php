<?php

namespace App\Controller;

use App\Entity\Classement;
use App\Repository\ClassementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RankingController extends AbstractController
{
    #[Route('/ranking', name: 'app_ranking')]
    public function showRanking(
        ClassementRepository $classementRepository
    ): Response
    {
        $user = $this->getUser();

        $allRankCurrentYear = $classementRepository->findByCurrentYear($user);

        return $this->render(
            'ranking/rank.html.twig', [
            'allRankCurrentYear' => $allRankCurrentYear
        ]);
    }
}
