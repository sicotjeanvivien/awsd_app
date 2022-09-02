<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/organisator')]
class OrganisatorController extends AbstractController
{
    #[Route('', name: 'app_organisator', methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('organisator/index.html.twig', [
            'controller_name' => 'OrganisatorController',
        ]);
    }
}
