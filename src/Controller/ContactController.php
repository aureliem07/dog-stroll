<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{    
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerService $mailer): Response
    {   
        $info="";
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){       
            $mailer->send(
                'aurelie.m.contact@gmail.com',
                $contact->getEmail(),
                $contact->getSubject(),
                $contact->getContent()
            );

            $info = 'Votre email est bien envoyé!';
        }
        return $this->render('mailer/contact.html.twig', [
            'contactForm' => $form->createView(),
            'info' => $info
        ]);
    }

}
