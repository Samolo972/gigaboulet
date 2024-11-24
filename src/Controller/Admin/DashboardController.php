<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Entity\MatchF;
use App\Entity\Tag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\ExpressionLanguage\Expression;


class DashboardController extends AbstractDashboardController
{

    // #[IsGranted(attribute: new Expression('is_granted("ROLE_ADMIN")'))]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GigaBoulet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les articles', 'fas fa-book', Article::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Les équipes', 'fas fa-team', Equipe::class);
        yield MenuItem::linkToCrud('Les joueurs', 'fas fa-player', Joueur::class);
        yield MenuItem::linkToCrud('Les catégories', 'fas fa-car', Categorie::class);
        yield MenuItem::linkToCrud('Les Tags', 'fas fa-tag', Tag::class);
        yield MenuItem::linkToCrud('Les Matchs', 'fas fa-soccer', MatchF::class);
    }
}