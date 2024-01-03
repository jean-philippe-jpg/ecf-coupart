<?php

namespace App\Controller;


use App\Entity\Commentaire;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Recettes;
use App\Repository\CommentaireRepository;
use App\Repository\RecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiteursController extends AbstractController
{
    #[Route('/', name: 'app_visiteurs', methods: ['GET'])]
    public function index(CommentaireRepository $CommentaireRepository, RecettesRepository $RecettesRepository,
    PaginatorInterface $paginator, Request $request)
    : Response
    {
        $data = $RecettesRepository->findAll([]);
       
        $recettes = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            3
        );
        $datas = $CommentaireRepository->findAll([]);
        $comments = $paginator->paginate(
            $datas,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('visiteurs/index.html.twig', [
            'total' => $recettes,
            'totalComments' =>$comments,
        ]);
    }

   
}
