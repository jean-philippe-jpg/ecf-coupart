<?php

namespace App\Controller\Admin;

use App\Entity\Recettes;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecettesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recettes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
        yield TextField::new('allergene');
        yield TextField::new('regime');
        yield AssociationField::new('users');
        
        
    }

};



