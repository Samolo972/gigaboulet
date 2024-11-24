<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('auteur'),
            TextField::new('contenu'),
            DateField::new("dateDePublication"),
            AssociationField::new('tags'),
            TextareaField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms()
                ->setLabel('Mettre une image'),

            ImageField::new('imageName')
                ->setBasePath('public/images/articles') // Chemin de base pour l'affichage des images
                ->hideOnForm(), // Cacher dans les formulaires

        ];
    }
}
