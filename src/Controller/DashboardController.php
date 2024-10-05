<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Rencontre;
use App\Repository\UserRepository;
use App\Repository\RencontreRepository;
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
        TournamentRepository $tournamentRepo
    ): Response
    {
        
        $user = $this->getUser();
        
        $allUserVictories = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Victoire']));

        $allUserDefeats = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Défaite']));

        $formattedPercentage = $this->userPourcentageVictory($rencontreRepository, $user);
        $lastMatch = $this->userLastMatch($rencontreRepository, $user);
        $nextTournament = $this->userNextTournament($tournamentRepo, $user);
        


        return $this->render('home/dashboard.html.twig', [
            'victoires' => $allUserVictories,
            'défaites' => $allUserDefeats,
            'pourcentage' => $formattedPercentage,
            'lastMatch' => $lastMatch,
            'nextTournament' => $nextTournament,
        ]);
    }

    public function userPourcentageVictory(RencontreRepository $rencontreRepository, $user): float
    {

    $allUserVictories = count($rencontreRepository->findBy(['user'=> $user, 'resultat'=> 'Victoire']));
    $allUserDefeats = count($rencontreRepository->findBy(['user'=> $user, 'resultat'=> 'Défaite']));

    $totalMatches = $allUserVictories + $allUserDefeats;

    if ($totalMatches != 0) {
        $victoryPercentage = ($allUserVictories / $totalMatches) * 100;
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
