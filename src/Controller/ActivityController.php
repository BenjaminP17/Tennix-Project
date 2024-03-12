<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Form\NewMatchFormType;
use App\Repository\RencontreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActivityController extends AbstractController
{
    #[Route('/matchs', name: 'app_matchs', methods: ['GET'])]
    public function index(
        RencontreRepository $RencontreRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {

        $data = $RencontreRepository->findAll();
        $rencontres = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            // nombre de matchs affichés par page
            8
        );
        

        return $this->render('activity/matchs.html.twig', [
            'rencontres'=> $rencontres,
        ]);
    }

    // Ajouter un match au palmarès à l'utilisateur connecté
    #[Route('/matchs/ajout', name: 'app_matchs_ajout')]
    public function add (
        Request $request,
        EntityManagerInterface $em
        ): Response
    {
        $rencontre = new Rencontre();

        $user = $this->getUser();

        $rencontre->setUser($user);

        $form = $this->createForm(NewMatchFormType::class, $rencontre);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {
            

            $em->persist($rencontre);
            $em->flush();

            $this->addFlash('success', 'Match ajouté à votre palmarès');

            return $this->redirectToRoute('app_matchs');
        }

        
        return $this->render('partials/_add_match_form.html.twig', [
            'matchForm' => $form->createView(),
        ]);
    }
}
