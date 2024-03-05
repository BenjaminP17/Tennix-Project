<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
