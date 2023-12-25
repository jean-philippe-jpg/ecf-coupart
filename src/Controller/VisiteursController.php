<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Repository\RecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteursController extends AbstractController
{
    #[Route('/visiteurs', name: 'app_visiteurs', methods: ['GET'])]
    public function index(RecettesRepository $RecettesRepository): Response
    {
        return $this->render('visiteurs/index.html.twig', [
            'total' => $RecettesRepository->findby([]),
        ]);
    }
}
