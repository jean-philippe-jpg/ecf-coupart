<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Recettes;
use App\Entity\CommentsRecettes;
use App\Form\CommentsRecettesType;
use App\Repository\UserRepository;
use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/', name: 'app_accueil')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(RecettesRepository $RecettesRepository): Response
    {

        $Recette = $RecettesRepository->findBy([], [ 'id' => 'DESC']);
        
        return $this->render('admin/index.html.twig', [

            'recettes' => $Recette
        ]);
    }


    // liste des utilisateurs

    #[Route('/utilisateurs', name: 'utilisateurs')]
    public function listeUtilisateurs(UserRepository $User): response
    {
       return $this->render('admin/utilisateurs.html.twig', [

        'users' => $User->findAll()
       ]);

    }

    #[Route('/detail/{id}', name: 'app_detail_recette')]
    public function detail(Recettes $recette): response
    {
        

         $form = $this->createForm(CommentsRecettesType::class);
       return $this->render('admin/detail.html.twig', [
        'detail' => $recette,
        'commentaire' => $form,
       ]);

    }
}
