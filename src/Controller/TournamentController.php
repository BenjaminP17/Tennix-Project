<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentFormType;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TournamentController extends AbstractController
{
    // Affichage des tournois par date, ordre décroissant. 
    #[Route('/tournament', name: 'app_tournament')]
    public function index(
        TournamentRepository $tournamentRepo,
        Request $request
    ): Response
    {
        $tournamentsList = ($tournamentRepo->findBy(['user'=> $this->getUser()], ['date'=>'ASC']));

        return $this->render('tournament/tournaments.html.twig', [
            'tournamentsList' => $tournamentsList,
        ]);
    }

    // Ajout d'un tournoi au calendrier de l'utilisateur 
    #[Route('/tournament/ajout', name: 'app_tournament_Form')]
    public function add(
        Request $request,
        EntityManagerInterface $em
    ): Response
    {   
        $tournament = new Tournament();

        $user = $this->getUser();

        $tournament->setUser($user);

        $form = $this->createForm(TournamentFormType::class, $tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $em->persist($tournament);
            $em->flush();

            $this->addFlash('success', 'Votre match est désormais consultable dans votre palmarès');

            return $this->redirectToRoute('app_matchs');
        }

        return $this->render('Form/_add_tournament_form.html.twig', [
            'tournamentForm' => $form->createView(),
        ]);
    }


}
