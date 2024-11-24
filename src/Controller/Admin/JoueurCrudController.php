<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JoueurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Joueur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('numero'),
            TextField::new('poste'),
            AssociationField::new('equipe')

        ];
    }
}
