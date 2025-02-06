<?php

namespace App\Controller\Admin;

use App\Entity\Players;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlayersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Players::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('user_id', 'Joueur'),
            AssociationField::new('team_id', 'Équipe'),
        ];
    }

}
