<?php

namespace App\Controller\Page;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/projects')]
class ProjectsController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializerInterface,
        private ProjectRepository $projectRepository
        ) {
    }

    #[Route('', name: 'app_projects', methods:["GET"])]
    public function index(): Response
    {
        return $this->render('/projects/index.html.twig', [
            'projects' => $this->serializerInterface->serialize($this->projectRepository->findAll(), "json")
        ]);
    }

    #[Route('/morpion', name: 'projects_morpion', methods:["GET"])]
    public function morpion()
    {
        return $this->render('/projects/morpion/index.html.twig');
    }
 
    #[Route('/candy_crush', name: 'projects_candy_crush', methods:["GET"])]
    public function candy_crush()
    {
        return $this->render('/projects/candy_crush/index.html.twig');
    }
 
    #[Route('/chuck_norris_fact', name: 'projects_chuck_norris_fact', methods:["GET"])]
    public function chuck_norris_fact()
    {
        return $this->render('/projects/chuck_norris_fact/index.html.twig');
    }
   
    #[Route('/calculatrice', name: 'projects_calculatrice', methods:["GET"])]
    public function calculatrice()
    {
        return $this->render('/projects/calculatrice/index.html.twig');
    }


}
