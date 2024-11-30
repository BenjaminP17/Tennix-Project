<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Rencontre;
use App\Repository\UserRepository;
use App\Repository\RencontreRepository;
use App\Repository\ClassementRepository;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    // Dashboard utilisateur
    #[Route('/dashboard', name: 'dashboard')]
    public function showStatsUser(
        UserRepository $userRepo,
        RencontreRepository $rencontreRepository,
        TournamentRepository $tournamentRepo,
        ClassementRepository $classementRepository
    ): Response
    {
        
        $user = $this->getUser();

        $allUserVictoriesCurrentYear = $rencontreRepository->AllVictoriesCurrentYear($user);

        $allUserMatchsPlayedCurrentYear = $rencontreRepository->AllMatchsCurrentYear($user);

        $allUserDefeatsCurrentYear = $rencontreRepository->AllDefeatsCurrentYear($user);

        $formattedPercentage = $this->userPourcentageVictory($rencontreRepository, $user);

        $lastMatch = $this->userLastMatch($rencontreRepository, $user);

        $nextTournament = $this->userNextTournament($tournamentRepo, $user);

        $ranksMapping = [
            1 => '40',
            2 => '30/5',
            3 => '30/4',
            4 => '30/3',
            5 => '30/2',
            6 => '30/1',
            7 => '30',
            8 => '15/5',
            9 => '15/4',
            10 => '15/3',
            11 => '15/2',
            12 => '15/1',
            13 => '15',
            14 => '5/6',
            15 => '4/6',
            16 => '3/6',
            17 => '2/6',
            18 => '1/6',
            19 => '0',
            20 => '-2/6',
            21 => '-4/6',
            22 => '-15',
        ];

        $currentRank = $classementRepository->currentRank($user);

        return $this->render('home/dashboard.html.twig', [
            'victoires' => $allUserVictoriesCurrentYear,
            'défaites' => $allUserDefeatsCurrentYear,
            'pourcentage' => $formattedPercentage,
            'lastMatch' => $lastMatch,
            'nextTournament' => $nextTournament,
            'allMatchs' => $allUserMatchsPlayedCurrentYear,
            'currentRank' => $currentRank,
            'ranksMapping' => $ranksMapping 
        ]);
    }

    public function userPourcentageVictory(RencontreRepository $rencontreRepository): float
    {
        $user = $this->getUser();
        
        $allUserVictoriesCurrentYear = $rencontreRepository->AllVictoriesCurrentYear($user);

        $allUserDefeatsCurrentYear = $rencontreRepository->AllDefeatsCurrentYear($user);

        $totalMatches = $allUserVictoriesCurrentYear + $allUserDefeatsCurrentYear;

        if ($totalMatches != 0) {
            $victoryPercentage = ($allUserVictoriesCurrentYear / $totalMatches) * 100;
            return number_format($victoryPercentage, 1);
        } else {
            return 0;
        }

    }

    public function userLastMatch(RencontreRepository $rencontreRepository, $user)
    {
        return $rencontreRepository->findBy(['user'=> $user], ['date'=>'DESC'], 1);
    }

    public function userNextTournament(TournamentRepository $tournamentRepo, $user)
    {
        return $tournamentRepo->findBy(['user'=> $user], ['date'=>'ASC']);
    }

    public function userCurrentRank(ClassementRepository $classementRepository, $user)
    {
        return $classementRepository->findBy(['user'=> $user], ['date'=>'DESC'], 1);
    }
    
    #[Route('/profil/edit', name: 'edit_profil', methods: ['GET', 'POST'])]
    public function editProfil(
        Request $request,
        EntityManagerInterface $em
    ): Response
    {   
        $user = $this->getUser();
        
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            // $this->addFlash('success', 'Vos informations ont bien été modifiées');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('Form/edit_profil_form.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    #[Route('/profil/delete', name: 'delete_profil')]
    public function deleteProfil(
        Request $request,
        EntityManagerInterface $em
    ): Response
    {   
        $user = $this->getUser();
        $this->container->get('security.token_storage')->setToken(null);

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !'); 

        return $this->redirectToRoute('app_login');
    }

}
