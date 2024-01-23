<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\RecettesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil')]

    public function recettes( Request $Request, RecettesRepository $RecettesRepository, EntityManagerInterface $entityManager): Response
    {
            $totals = $RecettesRepository->findBy([], ['id' => 'DESC']);
            $recette = 'liste des recettes du patient';

        return $this->render('profil/recettes.html.twig', [ 

            'recette' => $recette,
            'totals' => $totals,
        ]);
       
    }

   
}
