<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function account(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $dogs = $user->getDogs();

        return $this->render('account/account.html.twig', [
            'dogs' => $dogs
        ]);
    }

    #[Route('/edit-account/{user}', name: 'edit_account')]
    public function editAccount(EntityManagerInterface $em, User $user, Request $request): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message = 'Votre compte a été modifié.';
            $this->addFlash('sucess', $message);
            $em->flush();
            return $this->redirectToRoute('account');
        }
            
        return $this->render('account/editAccount.html.twig', [
            'userForm' => $form->createView()
        ]);

    }

    #[Route('/remove-account/{user}', name: 'remove_account')]
    public function removeAccount(EntityManagerInterface $em, User $user): Response
    {
        $em->remove($user);
        $em->flush();
            
        return $this->redirectToRoute('home'); 
        
    }

}
