<?php

namespace App\Controller\Admin;

use App\Entity\TeamTournament;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TeamTournamentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeamTournament::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideOnForm(),
            AssociationField::new('tournament_id', 'Tournois')->setFormTypeOptions(['multiple' => true, 'expanded' => true]),
            AssociationField::new('team_id', 'Équipes')->setFormTypeOptions(['multiple' => true, 'expanded' => true]),
        ];
    }
}
