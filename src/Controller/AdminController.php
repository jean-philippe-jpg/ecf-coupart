<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Regimes;
use App\Entity\Recettes;
use App\Entity\Allergenes;
use App\Entity\CommentsRecettes;
use App\Form\CommentsRecettesType;
use App\Repository\UserRepository;
use App\Repository\RecettesRepository;
use App\Repository\AllergenesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Repository\CommentsRecettesRepository;
use App\Repository\RegimesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class AdminController extends AbstractController
{
    #[Route('/', name: 'app_index_recette')]
    public function index( RecettesRepository $RecettesRepository, ParameterBagInterface $parameterBagInterface, Request $request): Response
    {
        
        #$recettes = $RecettesRepository->findBy([], ['id' => 'DESC']);
          # $recettes = $RecettesRepository->findAll();
           return $this->render('admin/index.html.twig', [
            'recettes' => $RecettesRepository->findAll(),
            #'allergene' => $Allergenes->findAll(),
        ]);
            
           
     }
    

    #[Route('/recette/{recette}', name: 'app_detail_recette')]
    public function detail(  CommentsRecettesRepository $commentsRecettesRepository, Recettes $recette, Request $request, EntityManagerInterface $entityManager, Security $security): response
    {

            $moyenneNotes = $commentsRecettesRepository->getMoyenneNotes($recette->getId());
            
             
            $user = $security->getUser();

            $commentaire = $commentsRecettesRepository->findOneBy(['recettes' => $recette, 'users' => $user]);
            
              

                if (!$commentaire) {
                    $commentaire = new CommentsRecettes();
            $commentaire->setRecettes($recette);
            $commentaire->setUsers($user);
            
                  
                }

            $form = $this->createForm(CommentsRecettesType::class, $commentaire);
            $form->handleRequest($request);


            if ($form->isSubmitted() && $form->isValid()){
                
                $entityManager->persist($commentaire);
                $entityManager->flush();

            }

         return $this->render('admin/detail.html.twig', [
        'recette' => $recette,
        'form' => $form->createView(),
        'user' => $user,
        'moyenne' => $moyenneNotes,
        
        
       ]);

    }


      #[Route('/utilisateurs', name: 'utilisateurs')]
      public function listeUtilisateurs(RegimesRepository $Regimes, UserRepository $User): response
      {
         return $this->render('admin/utilisateurs.html.twig', [
          'users' => $User->findAll(),
          'regime' => $Regimes->findAll(),
         ]);
  
      }
    }


    
    // liste des utilisateurs

   

