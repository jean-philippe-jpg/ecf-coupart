<?php

namespace App\Controller;


namespace App\Controller;

use App\Repository\RecettesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/accueil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]

    public function recettes( Request $Request, RecettesRepository $RecettesRepository, EntityManagerInterface $entityManager): Response
    {
            $totals = $RecettesRepository->findBy([], ['id' => 'DESC']);
            $recette = 'liste des recettes ';

        return $this->render('profil/recettes.html.twig', [ 

            'recette' => $recette,
            'totals' => $totals,
        ]);
       
    }



   
}
