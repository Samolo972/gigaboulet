<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home.page')]
    public function index(ArticleRepository $articleRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $query = $articleRepository->findAllOrderedByDate();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('home_page/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/fr/article/{slug}', name: 'article_show')]
    public function show(Article $article, ArticleRepository $articleRepository): Response
    {
        // Récupération d'articles suggérés
        $suggestion = $articleRepository->findRandomArticles();

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'suggestion' => $suggestion,
        ]);
    }

    #[Route('/fr/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('contact/index.html.twig', []);
    }

    #[Route('/fr/politique/confidentialite', name: 'app_confen')]
    public function confen(): Response
    {
        return $this->render('confen/index.html.twig', []);
    }

    #[Route('/fr/conditions/utilisation', name: 'app_condition')]
    public function conditions(): Response
    {
        return $this->render('conditions/index.html.twig', []);
    }
}
