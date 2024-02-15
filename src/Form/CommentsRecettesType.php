<?php

namespace App\Form;

use App\Entity\CommentsRecettes;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentsRecettesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('note', ChoiceType::class, [
            'label' => 'votre note',
            'choices'=> [
                '5' => 5,
                '4' => 4,
                '3' => 3,
                '2' => 2,
                '1' => 1,
            ],
            'attr' => [
                
                'class' => 'note'
            ],
            
            'expanded' => true,
            'multiple' => false,
        ])
            ->add('pseudo')
            ->add('message', TextareaType::class)
           
            ->add('envoyer', SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommentsRecettes::class,
        ]);
    }
}
