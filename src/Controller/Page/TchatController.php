<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/tchat")]
class TchatController extends AbstractController
{
    #[Route('', name: 'app_tchat', methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('tchat/index.html.twig', [
            'controller_name' => 'TchatController',
        ]);
    }
}
