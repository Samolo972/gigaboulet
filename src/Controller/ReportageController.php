<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportageController extends AbstractController
{
    #[Route('/fr/reportage', name: 'app_reportage')]
    public function index(): Response
    {
        return $this->render('reportage/index.html.twig', []);
    }

    #[Route('/analyse ', name: 'app_analyse')]
    public function analyse(): Response
    {
        return $this->render('analyse/index.html.twig', []);
    }
}
