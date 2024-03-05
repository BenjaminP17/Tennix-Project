<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivityController extends AbstractController
{
    #[Route('/matchs', name: 'app_activity')]
    public function index(): Response
    {
        return $this->render('activity/matchs.html.twig', [
            'controller_name' => 'ActivityController',
        ]);
    }
}
