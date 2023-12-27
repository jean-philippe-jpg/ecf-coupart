<?php

namespace App\Controller;


use app\form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_', methods: ['GET', 'POST'])]
    public function new(Request $request, MailerInterface $mailer): Response
    {
       
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact->setCreatedAt( new DateTimeImmutable());
            $contactRepositore->save($contact, true);

            $data = $form->getData();
            
            $email= $data['email'];
            $username= $data['username'];
            $objet= $data['object'];
            $message= $data['message'];
           
            $email = (new Email())

           ->from('admin@admin.com')
            ->to($email)
            ->subject($objet)
            ->text($message);
            
           
        $mailer->send($email);

       }
        return $this->renderForm('contact/index.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

}
