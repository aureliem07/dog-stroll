<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserStrollsController extends AbstractController
{
    #[Route('/user-strolls', name: 'user_strolls')]
    public function index(): Response
    {

        
        return $this->render('user_strolls/userStrolls.html.twig', [
            'controller_name' => 'UserStrollsController',
        ]);
    }
}
