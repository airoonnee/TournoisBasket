<?php

namespace App\Controller\Admin;

use App\Entity\Teams;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class TeamsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teams::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID'),
            TextField::new('name', 'Nom de l\'équipe'),
            ImageField::new('logo_url', 'Logo')->setBasePath('uploads/logos')->setUploadDir('public/uploads/logos'),
        ];
    }
}
