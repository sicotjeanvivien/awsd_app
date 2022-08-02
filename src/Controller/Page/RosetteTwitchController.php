<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/page/rosette-twitch')]
class RosetteTwitchController extends AbstractController
{
    #[Route('', name: 'app_rosette_twitch')]
    public function index(): Response
    {
        return $this->render('rosette_twitch/index.html.twig', [
            'controller_name' => 'RosetteTwitchController',
        ]);
    }
}
