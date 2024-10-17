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
        ClassementRepository $classRepo
    ): Response
    {

        $classementList = ($classRepo->findBy(['user'=> $this->getUser()]));

        return $this->render('ranking/index.html.twig', [
            'classementList' => $classementList,
        ]);
    }
}
