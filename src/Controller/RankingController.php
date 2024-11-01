<?php

namespace App\Controller;

use App\Entity\Classement;
use App\Form\AddNewRankType;
use App\Repository\ClassementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RankingController extends AbstractController
{
    #[Route('/ranking', name: 'app_ranking')]
    public function showRanking(
        ClassementRepository $classementRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        $user = $this->getUser();

        $monthlyRanks = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRanks[$month] = $classementRepository->findByCurrentYearAndMonth($user, $month);
        }

        $classement = new Classement();

        $form = $this->createForm(AddNewRankType::class, $classement);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $this->getUser(); 

            $classement->setUser($user);
            
            $em->persist($classement);
            $em->flush();

            return $this->redirectToRoute('app_ranking');

        }
        
        return $this->render(
            'ranking/rank.html.twig', [
            'monthlyRanks' => $monthlyRanks,
            'form' => $form->createView()
        ]);

    }
    
}
