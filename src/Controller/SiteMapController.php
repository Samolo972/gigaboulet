<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteMapController extends AbstractController
{
    #[Route("sitemap.xml", name: 'sitemap', format: 'xml')]
    public function sitemapAction(EntityManagerInterface $entityManager): Response
    {
        // Récupération des articles
        $articles = $entityManager->getRepository(Article::class)->findAll();
        $urls = [];

        // Routes principales
        $urls[] = ['loc' => $this->generateUrl('home.page')];
        $urls[] = ['loc' => $this->generateUrl('app_reportage')];
        $urls[] = ['loc' => $this->generateUrl('app_analyse')];
        $urls[] = ['loc' => $this->generateUrl('app_contact')];
        $urls[] = ['loc' => $this->generateUrl('app_confen')];
        $urls[] = ['loc' => $this->generateUrl('app_condition')];

        // Routes des articles
        foreach ($articles as $article) {
            $urls[] = [
                'loc' => $this->generateUrl('article_show', ['slug' => $article->getSlug()]),
                // pensez à créer la propriété de l'entité  
                'lastmod' => $article->getDateDePublication()?->format('Y-m-d'),
            ];
        }

        return $this->render('site_map/sitemap.xml.twig', [
            'urls' => $urls,
        ]);
    }
}
