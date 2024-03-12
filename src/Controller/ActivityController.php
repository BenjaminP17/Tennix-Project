<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Repository\RencontreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
}
