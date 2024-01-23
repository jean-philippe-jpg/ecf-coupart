<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recettes;
use App\Entity\CommentsRecettes;
use App\Form\CommentsRecettesType;
use App\Repository\UserRepository;
use App\Repository\RecettesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AdminController extends AbstractController
{
    #[Route('/', name: 'app_index_recette')]
    public function index(RecettesRepository $RecettesRepository, ParameterBagInterface $parameterBagInterface, Request $request): Response
    {
        $limit = $parameterBagInterface->get('home_recipes_limit');
        $Recettes = $RecettesRepository->findBy([], [ 'id' => 'DESC'],  $limit);
        
        return $this->render('admin/index.html.twig', [
            'recettes' => $Recettes
        ]);
    }


    #[Route('/recette/{recette}', name: 'app_detail_recette')]
    public function detail(Recettes $recette, Request $request, EntityManagerInterface $entityManagerInterface): response
    {
            
            $commentaire = new CommentsRecettes();
            $form = $this->createForm(CommentsRecettesType::class, $commentaire);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()){
                
                $entityManagerInterface->persist($commentaire);
                $entityManagerInterface->flush();

            }

         return $this->render('admin/detail.html.twig', [
        'recette' => $recette,
        'form' => $form->createView()
       ]);

    }


      #[Route('/utilisateurs', name: 'utilisateurs')]
      public function listeUtilisateurs(UserRepository $User): response
      {
         return $this->render('admin/utilisateurs.html.twig', [
  
          'users' => $User->findAll()
         ]);
  
      }
    }


    
    // liste des utilisateurs

   

