<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainDashboardController extends AbstractController
{
    /**
     * @Route("/main/dashboard", name="app_main_dashboard")
     */
    public function index(): Response
    {
        return $this->render('main_dashboard/index.html.twig', [
            'controller_name' => 'MainDashboardController',
        ]);
    }
}
