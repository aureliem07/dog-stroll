<?php

namespace App\Controller;

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

}
