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
    public function index(
        UserRepository $userRepo,
        RencontreRepository $rencontreRepository,
        TournamentRepository $tournamentRepo
    ): Response
    {
        // Récupération du nombre de victoire/defaite 

        $victoires = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Victoire']));
        $defaites = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Défaite']));

        // Calcul du pourcentage de victoire 

        $nbrVictoires = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Victoire']));
        $nbrDefaites = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Défaite']));

        $totalMatches = $nbrVictoires + $nbrDefaites;
//         $victoryPercentage = ($nbrVictoires / $totalMatches) * 100;
// // ----- 
//         $formattedPercentage = number_format($victoryPercentage, 1);

//!! condition, si le joueur n'a aucun match dans son palmarès
        if ($totalMatches != 0) {
            $victoryPercentage = ($nbrVictoires / $totalMatches) * 100;
            $formattedPercentage = number_format($victoryPercentage, 1);
        } else {
            $formattedPercentage = 0;
        }
// ---- 
        // Dernière rencontre de l'utilisateur 

        $lastMatch = ($rencontreRepository->findBy(['user'=> $this->getUser()], ['date'=>'DESC'], 1));

        // Prochaine compétition de l'utilisateur 

        $nextTournament = ($tournamentRepo->findBy(['user'=> $this->getUser()]));

        // Récupération de l'utilisateur connecté

        // $userPhoto = ($userRepo->findBy(['imageName'=> $this->getUser()])); 

        // dd($userPhoto);

        return $this->render('home/dashboard.html.twig', [
            'victoires' => $victoires,
            'défaites' => $defaites,
            'pourcentage' => $formattedPercentage,
            'lastMatch' => $lastMatch,
            'nextTournament' => $nextTournament,
        ]);
    }

    
    // Modification des informations de utilisateur connecté
    #[Route('/profil/edit', name: 'edit_profil', methods: ['GET', 'POST'])]
    public function edit(
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

}
