<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchController extends AbstractController
{
    #[Route('/fr/match', name: 'app_match')]
    public function index(): Response
    {
        return $this->render('match/index.html.twig', []);
    }
}
