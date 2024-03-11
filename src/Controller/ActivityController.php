<?php

namespace App\Controller;

use App\Entity\Rencontre;
use App\Repository\RencontreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActivityController extends AbstractController
{
    #[Route('/matchs', name: 'app_matchs', methods: ['GET'])]
    public function index(
        RencontreRepository $RencontreRepository
    ): Response
    {

        $rencontres = $RencontreRepository->findAll();

        return $this->render('activity/matchs.html.twig', [
            'rencontres'=> $rencontres,
        ]);
    }
}
