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
    #[Route('/stroll/{id}', name: 'stroll')]
    public function stroll(int $id, StrollRepository $repo): Response
    {     
        $stroll = $repo->find($id);
        $subscribers = $stroll->getSubscribers();

        return $this->render('stroll/stroll.html.twig', [
            'stroll' => $stroll,
            'subscribers' => $subscribers
        ]);
    }

    #[Route('/subscribe/{stroll}/{user}', name: 'subscribe_stroll')]
    public function addStrollSubscription(Stroll $stroll, User $user, EntityManagerInterface $em): Response
    {     
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->addStrollSubscription($stroll);
        $em->flush();
 
        return $this->redirectToRoute('stroll', [
            'id' => $stroll->getId()
        ]);
    }
}
