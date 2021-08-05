<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Stroll;
use App\Repository\StrollRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StrollController extends AbstractController
{
    #[Route('/event/{id}', name: 'stroll')]
    public function stroll(int $id, StrollRepository $repo): Response
    {     
        $stroll = $repo->find($id);

        $users = $stroll->getUsers();

        return $this->render('stroll/stroll.html.twig', [
            'stroll' => $stroll,
            'users' => $users
        ]);
    }

    #[Route('/add-user-stroll/{stroll}/{user}', name: 'add_user_stroll')]
    public function addUserStroll(Stroll $stroll, User $user, EntityManagerInterface $em): Response
    {     
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->addStroll($stroll);
        $em->flush();
 
        return $this->redirectToRoute('stroll', [ 'id' => $stroll->getId()]);
    }

}
