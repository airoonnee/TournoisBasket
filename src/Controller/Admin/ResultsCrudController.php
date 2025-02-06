<?php

namespace App\Controller\Admin;

use App\Entity\Results;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResultsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Results::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideOnForm(),
            AssociationField::new('martch_id', 'Matchs')->setFormTypeOptions([
                'by_reference' => false,
            ]),
            AssociationField::new('winner_team', 'Équipe gagnante')->setFormTypeOptions([
                'by_reference' => false,
            ]),
        ];
    }
}
