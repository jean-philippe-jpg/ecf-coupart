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



class PageController extends AbstractController
{
    #[Route('/', name: 'app_index_recette')]
    public function index( CommentsRecettesRepository $commentaire, RegimesRepository $RegimesRepository, AllergenesRepository $AllergenesRepository, RecettesRepository $RecettesRepository, Request $request): Response
    {
          
         //recuperation des recettes par l'id des type de regime et des allergenes
        $allergeneId = $request->get('allergeneId');
        $regimesId = $request->get('regimesId');

        // affichage du total des recettes
       $recette = $RecettesRepository->findRecettes($allergeneId, $regimesId);
        
       //recuperation de tous les type de regimes et des allergenes
       $allergenes = $AllergenesRepository->findAll();
       $regimes = $RegimesRepository->findAll();
       $commentaire = $commentaire->findAll();

       // affichage des données dans le template via la methode "render"
           return $this->render('pages/index.html.twig', [
            'recettes' => $recette,
            'allergene' => $allergenes,
            'regime' => $regimes,
            'commentaire' => $commentaire,
           
        ]);       
     }
    

    #[Route('/detail/{recette}', name: 'app_detail_recette')]
    public function detail( CommentsRecettesRepository $commentsRecettesRepository, Recettes $recette, Request $request, EntityManagerInterface $entityManager, Security $security): response
    {
            // récuperation de la moyenne des notes
            $moyenneNotes = $commentsRecettesRepository->getMoyenneNotes($recette->getId());

            // recuperation d'un utilisateur 
            $user = $security->getUser();
            $commentaire = $commentsRecettesRepository->findOneBy([ 'recettes' => $recette, 'users' => $user]);
            

            // possibilité de laisser un commentaire s'il est null
                if (!$commentaire) {
                    $commentaire = new CommentsRecettes();
            $commentaire->setRecettes($recette);
            $commentaire->setUsers($user);
                }

            // recupération du formulaire 
            $form = $this->createForm(CommentsRecettesType::class, $commentaire);
            $form->handleRequest($request);

            // si le formulaire est valide, les données sont percisté dans la base de sonnées
            if ($form->isSubmitted() && $form->isValid()){
                $entityManager->persist($commentaire);
                $entityManager->flush();
            }
            // affichage des données dans le template via la methode "render"
         return $this->render('pages/detail.html.twig', [
        'recette' => $recette,
        'form' => $form->createView(),
        'user' => $user,
        'moyenne' => $moyenneNotes,
        
       ]);

    }


    #[Route('/mon_compte', name: 'app_mon_compte')]

    public function compte(Request $request,  AllergenesRepository $AllergenesRepository, RecettesRepository $RecettesRepository): Response
 {

    // affichage des allergenes correspondant aux recettes
    $allergeneId = $request->get('allergeneId');
    $recette = $RecettesRepository->findRecettes($allergeneId);

    //recuperation de tous les allergenes
    $allergenes = $AllergenesRepository->findAll();
            
         // affichage des données dans le template via la methode "render"
        return $this->render('profil/index.html.twig', [ 
            'recettes' => $recette,
            'allergene' => $allergenes,
            
        ]);
       
    }


      #[Route('/utilisateurs', name: 'utilisateurs')]
      public function listeUtilisateurs( RegimesRepository $Regimes, UserRepository $User): response
      {
            // affichage de la liste des utilisateurs
         return $this->render('pages/utilisateurs.html.twig', [
          'users' => $User->findAll(),
          'regime' => $Regimes->findAll(),
         
         ]);
  
      }

      #[Route('/test', name: 'app_test_recette')]
    public function test(RegimesRepository $Regimes): Response
    {
         
            $Regime = $Regimes->findAll();


       // affichage des données dans le template via la methode "render"
           return $this->render('pages/test.html.twig', [
            
            'regimes' => $Regime,
        ]);       
     }
      


}

    


    
 

   

