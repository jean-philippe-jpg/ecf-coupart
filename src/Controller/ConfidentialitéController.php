<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfidentialitéController extends AbstractController
{
    #[Route('/confidentialit/', name: 'app_confidentialit_')]
    public function index(): Response
    {
        return $this->render('confidentialité/index.html.twig', [
            'controller_name' => 'ConfidentialitéController',
        ]);
    }
}
