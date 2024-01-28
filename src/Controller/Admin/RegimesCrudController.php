<?php

namespace App\Controller\Admin;

use App\Entity\Regimes;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegimesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Regimes::class;
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
        #yield ArrayField::new('roles');
        #yield TextField::new('allergenes');
       #yield TextField::new('allergenes');
        yield AssociationField::new('users');
        #yield AssociationField::new('recettes');
        
        

    }
    
}
