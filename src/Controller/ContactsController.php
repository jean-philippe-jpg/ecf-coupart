<?php

namespace App\Controller;

use App\Form\ContactsType;
use App\Entity\Contacts;
use Symfony\Component\Mime\Email;
use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactsController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ContactsRepository $ContactsRepository, Request $request,  EntityManagerInterface $entityManager, MailerInterface $mailer ): Response
    {
        $contact = new Contacts;
        $contactForm = $this->createForm( ContactsType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()){

            $entityManager->persist($contact);
            $entityManager->flush();
            

            $email = $contact->getEmail();
            $nom = $contact->getNom();
            $prenom = $contact->getPrenom();
            $message = $contact->getMessage();

            $email =( new Email())

            ->from('toto@gmail.com')
            ->to($email)
            ->text($nom. $prenom. $message);


            $mailer->send($email);

           
            return $this->redirectToRoute('app_profil', []);
        }

        return $this->render('contacts/index.html.twig', [
            'contact' => $ContactsRepository->findby([]),
            'contactForm' => $contactForm->createView(),
        ]);
       
    }
}
