<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Stroll;
use App\Form\EditAccountType;
use App\Form\StrollType;
use App\Service\FileUploader;
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
    public function editAccount(FileUploader $fileUploader, EntityManagerInterface $em, User $user, Request $request): Response
    {
        $form = $this->createForm(EditAccountType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $user->setPictureFilename($pictureFileName);
            }
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

    #[Route('/strolls', name: 'strolls')]
    public function userStrolls(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $strolls = $user->getStrolls();

        return $this->render('account/strolls.html.twig', [
            'strolls' => $strolls
        ]);
    }

    #[Route('/add-stroll', name: 'add_stroll')]
    public function addStroll(EntityManagerInterface $em, Request $request): Response
    {     
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $stroll = new Stroll();
        $form = $this->createForm(StrollType::class, $stroll);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $stroll->setCreatedBy($this->get('security.token_storage')->getToken()->getUser());

            if ($form->isValid()) {
                $stroll->setValidate(false);
                $em->persist($stroll);
                $em->flush();

                return $this->redirectToRoute('strolls');
            }
        }

        return $this->render('account/addStroll.html.twig', [
            'strollForm' => $form->createView(),
        ]);
    }

    #[Route('/edit-stroll/{stroll}', name: 'edit_stroll')]
    public function editUserStroll(EntityManagerInterface $em, Stroll $stroll, Request $request): Response
    {
        $form = $this->createForm(StrollType::class, $stroll);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute('strolls');
        }
            
        return $this->render('account/editStroll.html.twig', [
            'strollForm' => $form->createView()
        ]);
        
    }

    #[Route('/remove-stroll/{stroll}', name: 'remove_stroll')]
    public function removeUserStroll(EntityManagerInterface $em, Stroll $stroll): Response
    {
        $em->remove($stroll);
        $em->flush();
            
        return $this->redirectToRoute('strolls'); 
        
    }
}
