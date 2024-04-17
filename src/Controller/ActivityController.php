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
    // Matchs affichés par dates décroissantes
    #[Route('/matchs', name: 'app_matchs', methods: ['GET'])]
    public function index(
        RencontreRepository $RencontreRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data = $RencontreRepository->findAllByDateDESC();
        $rencontres = $paginator->paginate(
        $data,
        $request->query->getInt('page', 1)
        );
        
        return $this->render('activity/matchs.html.twig', [
            'rencontres'=> $rencontres,
        ]);
    }

    // Ajouter un match au palmarès de l'utilisateur connecté
    #[Route('/matchs/ajout', name: 'app_matchs_add')]
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

            $this->addFlash('success', 'Votre match est désormais consultable dans votre palmarès');

            return $this->redirectToRoute('app_matchs');
        }

        return $this->render('Form/_add_match_form.html.twig', [
            'matchForm' => $form->createView(),
        ]);
    }

    // Supprimer un match
    #[Route('/matchs/supprimer/{id}', name: 'app_matchs_delete')]
    public function delete (
        Rencontre $rencontre,
        EntityManagerInterface $em
        ): Response
    {
        
        
        $em->remove($rencontre);
        $em->flush();

        $this->addFlash('success', 'Votre match à bien été supprimé');

        return $this->redirectToRoute('app_matchs');

    }

    // Modifier un match dans le palmarès
    #[Route('/matchs/edit/{id}', name: 'app_matchs_edit')]
    public function edit (
        Rencontre $rencontre,
        Request $request,
        EntityManagerInterface $em
        ): Response
    {

        if ($rencontre === null) {
            throw $this->createNotFoundException('Match non trouvé.');
        }
        
        $form = $this->createForm(NewMatchFormType::class, $rencontre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $rencontre = $form->getData();

            $em->persist($rencontre);
            $em->flush();

            $this->addFlash('success', 'Votre match à bien été modifié');

            return $this->redirectToRoute('app_matchs');
        }

        return $this->render('Form/_edit_match_form.html.twig', [
            'matchForm' => $form->createView(),
        ]);

    }

}
