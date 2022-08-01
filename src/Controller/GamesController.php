<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/games')]
class GamesController extends AbstractController
{
    #[Route('', name: 'app_games')]
    public function index(): Response
    {

        $games = [
            [
                "name" => "Morpion",
                "rules" => "Le premier joueur a aligner 3 symboles identiques gagne la partie. Attention, le joueur qui débute est toujours avantagé pour gagner. Pensez donc à alterner!",
                "image" => "/img/morpion_img.png",
                "link" => "game_morpion"
            ]
        ];

        return $this->render('/games/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/morpion', name: 'game_morpion')]
    public function morpion()
    {
        return $this->render('/games/morpion/index.html.twig');
    }
}
