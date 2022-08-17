<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MTGController extends AbstractController
{
    #[Route('/mtg', name: 'app_mtg')]
    public function index(): Response
    {
        return $this->render('mtg/index.html.twig', [
            'controller_name' => 'MTGController',
        ]);
    }
}
