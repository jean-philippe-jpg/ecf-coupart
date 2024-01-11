<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       yield from parent::configureFields($pageName);
       #$fields[
       # ChoiceField::new('roles')
       # -setChoices(['ROLE_ADMIN'=>'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER'])
       # -allowMultipleChoices()
       # -renderExpanded()
       #];
        yield ArrayField::new('roles');
        yield AssociationField::new('recettes');
        
        

    }
    
}
