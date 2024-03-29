<?php

namespace App\Controller\Admin;

use App\Entity\Recettes;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
        #yield TextField::new('allergenes');
        #yield TextField::new('regimes');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('imageName')->setBasePath('images/recettes')->hideOnForm();
        yield AssociationField::new('users');
        yield AssociationField::new('regimes');
        yield AssociationField::new('allergenes');
        
        
    }



};



