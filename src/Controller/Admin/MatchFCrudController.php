<?php

namespace App\Controller\Admin;

use App\Entity\MatchF;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;


class MatchFCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MatchF::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('equipe1'),
            AssociationField::new('equipe2'),
            NumberField::new('score_equipe1'),
            NumberField::new('score_equipe2'),
        ];
    }
}
