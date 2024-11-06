<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\ShowByYearType;
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
    public function showTournamentsCurrentAndSelectedYear(
        TournamentRepository $TournamentRepository,
        Request $request
    ): Response
    {
        $currentDate = new \dateTime();

        $user = $this->getUser();
       
        $form = $this->createForm(ShowByYearType::class);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $year = $form->get('year')->getData();
            
            $tournamentsList = $TournamentRepository->findBySelectedYear($year, $user);
        } else {
            
            $tournamentsList = $TournamentRepository->findByCurrentYear($user);
        }

        return $this->render('tournament/tournaments.html.twig', [
            'tournamentsList' => $tournamentsList,
            'currentDate' => $currentDate,
            'form' => $form->createView(),
        ]);
    }

    // Ajout d'un tournoi au calendrier de l'utilisateur 
    #[Route('/tournament/ajout', name: 'app_tournament_Form')]
    public function addTournament(
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

            $this->addFlash('success', 'Compétition ajoutée à votre calendrier');

            return $this->redirectToRoute('app_tournament');
        }

        return $this->render('Form/_add_tournament_form.html.twig', [
            'tournamentForm' => $form->createView(),
        ]);
    }

    #[Route('/tournament/delete/{id}', name: 'app_tournament_delete')]
    public function deleteTournament(
        Tournament $tournament,
        EntityManagerInterface $em
    ): Response
    {
        $em->remove($tournament);
        $em->flush();

        $this->addFlash('success', 'Votre tournoi à bien été supprimé');

        return $this->redirectToRoute('app_tournament');

    }

}
