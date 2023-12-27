<?php

namespace App\Controller;


use App\Form\CommentaireType;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommentaireRepository $CommentaireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire;
        $commentaireForm = $this->createForm( CommentaireType::class, $commentaire);
        $commentaireForm->handleRequest($request);

        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()){

               
            $entityManager->persist($commentaire);
            $entityManager->flush();
            

            $this->addFlash('message', 'je te souhaite un joyeux noel');
            return $this->redirectToRoute('app_visiteurs', []);
        }

        return $this->render('profil/index.html.twig', [
            'commentaire' => $CommentaireRepository->findby([]),
            'commentaireForm' => $commentaireForm->createView(),
        ]);
       
    }

   
}
