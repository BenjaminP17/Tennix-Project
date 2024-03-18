<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
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
    
}
