<?php

namespace App\Controller;

use App\Repository\StrollRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StrollRepository $repo): Response
    {   
        $strolls = $repo->findAll();


        return $this->render('home/home.html.twig', [
            'strolls' => $strolls
        ]);
    }

    #[Route('/évènement/{id}', name: 'stroll')]
    public function stroll(int $id, StrollRepository $repo): Response
    {     

        $stroll = $repo->find($id);

        return $this->render('home/stroll.html.twig', [
            'stroll' => $stroll
        ]);
    }
}
