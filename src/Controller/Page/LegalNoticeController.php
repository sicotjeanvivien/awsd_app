<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/legal-notice')]
class LegalNoticeController extends AbstractController
{
    #[Route('', name: 'app_legal_notice', methods:["GET"])]
    public function index(): Response
    {
        return $this->render('legal_notice/index.html.twig', [
            'controller_name' => 'LegalNoticeController',
        ]);
    }
}
