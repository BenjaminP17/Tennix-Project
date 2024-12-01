<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Form\ShowByYearType;
use App\Form\NewMatchFormType;
use App\Repository\RencontreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchController extends AbstractController
{
    #[Route('/matchs', name: 'app_matchs', methods: ['GET','POST'])]
    public function ShowAllMatchsUserAndAdd(
    RencontreRepository $RencontreRepository,
    PaginatorInterface $paginator,
    Request $request,
    EntityManagerInterface $em
    ): Response
    {

    $user = $this->getUser();
    // Sélection par année
    $form = $this->createForm(ShowByYearType::class);
    $form->handleRequest($request);

    
    if ($form->isSubmitted() && $form->isValid()) {
        $year = $form->get('year')->getData();
        
        $data = $RencontreRepository->findBySelectedYear($year, $user);
    } else {
        
        $data = $RencontreRepository->findByCurrentYear($user);
    }

    $rencontres = $paginator->paginate(
        $data,
        $request->query->getInt('page', 1), 10);

    //Création d'une rencontre    
    $rencontre = new Rencontre();

    $user = $this->getUser();

    $rencontre->setUser($user);

    $addMatchform = $this->createForm(NewMatchFormType::class, $rencontre);
    $addMatchform->handleRequest($request);

    if ($addMatchform->isSubmitted() && $addMatchform->isValid()) {
        
        $em->persist($rencontre);
        $em->flush();

        $this->addFlash('success', 'Votre match est désormais consultable dans votre palmarès');

        return $this->redirectToRoute('app_matchs');
    }

    return $this->render('match/matchs.html.twig', [
        'rencontres' => $rencontres,
        'form' => $form->createView(), 
        'matchForm' => $addMatchform->createView(),
    ]);
    }


    #[Route('/matchs/supprimer/{id}', name: 'app_matchs_delete')]
    public function deleteMatch (
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
    public function editMatch (
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

        return $this->render('Form/_add_match_form.html.twig', [
            'matchForm' => $form->createView(),
        ]);

    }

}