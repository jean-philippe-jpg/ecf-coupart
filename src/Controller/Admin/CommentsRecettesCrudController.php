<?php

namespace App\Controller\Admin;



use App\Entity\CommentsRecettes;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentsRecettesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CommentsRecettes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields($pageName);
       
        yield AssociationField::new('users');
        yield AssociationField::new('recettes');
        
    }
    
}
