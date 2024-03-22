<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Rencontre;
use App\Repository\UserRepository;
use App\Repository\RencontreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    // Dashboard utilisateur
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('home/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
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

            $this->addFlash('success', 'Vos informations ont bien été modifiées');

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('partials/edit_profil_form.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    // Affichage du nombre de victoire/défaite de l'utilisateur
    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    public function stats(
        RencontreRepository $rencontreRepository,
    ): Response
    {
        $victoires = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Victoire']));
        $defaites = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Défaite']));

    // Affichage du nombre de victoires de l'utilisateur connecté
    return $this->render('home/dashboard.html.twig', [
        'victoires' => $victoires,
        'défaites' => $defaites,
    ]);
    }

    // Calcul du pourcentage de victoire de l'utilisateur
    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    public function pourcentage(
        RencontreRepository $rencontreRepository,
    ): Response
    {
        $victoires = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Victoire']));
        $defaites = count($rencontreRepository->findBy(['user'=> $this->getUser(), 'resultat'=> 'Défaite']));

        $totalMatches = $victoires + $defaites;
        $victoryPercentage = ($victoires / $totalMatches) * 100;

        $formattedPercentage = number_format($victoryPercentage, 1);

        // dd($formattedPercentage);

    // Affichage du nombre de victoires de l'utilisateur connecté
    return $this->render('home/dashboard.html.twig', [
        'pourcentage' => $formattedPercentage,
        'victoires' => $victoires,
        'défaites' => $defaites,
    ]);
    }
    
}
