<?php

namespace App\Controller\Admin;

use App\Entity\Tournaments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TournamentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tournaments::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideOnForm(),
            TextField::new('name', 'Nom'),
            DateTimeField::new('start_date', 'Date de début')->setFormat('dd/MM/yyyy HH:mm'),
            DateTimeField::new('end_date', 'Date de fin')->setFormat('dd/MM/yyyy HH:mm'),
            IntegerField::new('max_teams', 'Nombre maximum d\'équipes'),
            DateTimeField::new('created', 'Créé le')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            DateTimeField::new('updated', 'Mis à jour le')->setFormat('dd/MM/yyyy HH:mm')->hideOnForm(),
            AssociationField::new('matches', 'Matches')->setFormTypeOptions(['multiple' => true, 'expanded' => true])->hideOnIndex(),
        ];
    }
}
