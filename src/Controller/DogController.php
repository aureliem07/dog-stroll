<?php

namespace App\Controller;

use App\Entity\Dog;
use App\Entity\User;
use App\Form\DogType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DogController extends AbstractController
{
    #[Route('/add-dog/{user}', name: 'add_dog')]
    public function addDog(FileUploader $fileUploader, EntityManagerInterface $em, User $user, Request $request): Response
    {
        $dog = new Dog();
        $form = $this->createForm(DogType::class, $dog);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            $dog->setUser($user);

            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $pictureFileName = $fileUploader->upload($pictureFile);
                $dog->setPictureFilename($pictureFileName);
            }

            $em->persist($dog);
            $em->flush();

            return $this->redirectToRoute('account'); 
        }

        return $this->render('dog/addDog.html.twig', [
            'dogForm' => $form->createView()
        ]);
    }

    #[Route('/remove-dog/{dog}', name: 'remove_dog')]
    public function removeDog(EntityManagerInterface $em, Dog $dog): Response
    {
        $em->remove($dog);
        $em->flush();
            
        return $this->redirectToRoute('account'); 
        
    }

    #[Route('/edit-dog/{dog}', name: 'edit_dog')]
    public function editDog(EntityManagerInterface $em, Dog $dog, Request $request): Response
    {
        $form = $this->createForm(DogType::class, $dog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message = 'Le chien ' .$dog->getName(). ' a été modifié.';
            $this->addFlash('sucess', $message);
            $em->flush();
            return $this->redirectToRoute('account');
        }
            
        return $this->render('dog/editDog.html.twig', [
            'dogForm' => $form->createView()
        ]);
        
    }

}
