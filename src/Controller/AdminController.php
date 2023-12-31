<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin', name: 'app_admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UserRepository $User): Response
    {
        return $this->render('admin/index.html.twig', [

            'users' => $User->findAll()
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
}
