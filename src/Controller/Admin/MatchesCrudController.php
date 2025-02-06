<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Fields;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MatchesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matches::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('match_date', 'Date du match'),
            AssociationField::new('team1_id', 'Équipe 1'),
            AssociationField::new('team2_id', 'Équipe 2'),
            IntegerField::new('team1_score', 'Score Équipe 1'),
            IntegerField::new('team2_score', 'Score Équipe 2'),
            AssociationField::new('tournament_id', 'Tournoi'),
            // ->formatValue(fn ($value, $entity) => $entity->getTournamentId()?->getName()),
        ];
    }
}
