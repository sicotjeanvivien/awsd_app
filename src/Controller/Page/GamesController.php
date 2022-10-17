<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/games')]
class GamesController extends AbstractController
{
    #[Route('', name: 'app_games', methods:["GET"])]
    public function index(): Response
    {
        $games = [
            [
                "name" => "Morpion",
                "rules" => "Le premier joueur a aligner 3 symboles identiques gagne la partie. Attention, le joueur qui débute est toujours avantagé pour gagner. Pensez donc à alterner!",
                "image" => "/img/morpion_img.png",
                "link" => "game_morpion"
            ],
            [
                "name" => "Cabdy-Crush v1",
                "rules" => "Aligner 3 bonbons identiques pour gagner des points.",
                "image" => "/img/candy_crush.png",
                "link" => "game_candy_crush"
            ],
            [
                "name" => "Chuck Norris Fact",
                "rules" => "Découvrez les Chuck Norris Facts, entièrement en Français. Servis avec amour et coups de pieds circulaires",
                "image" => "#",
                "link" => "game_chuck_norris_fact"
            ]
        ];

        return $this->render('/games/index.html.twig', [
            'games' => json_encode($games, JSON_FORCE_OBJECT) ,
        ]);
    }

    #[Route('/morpion', name: 'game_morpion', methods:["GET"])]
    public function morpion()
    {
        return $this->render('/games/morpion/index.html.twig');
    }
 
    #[Route('/candy_crush', name: 'game_candy_crush', methods:["GET"])]
    public function candy_crush()
    {
        return $this->render('/games/candy_crush/index.html.twig');
    }
 
    #[Route('/chuck_norris_fact', name: 'game_chuck_norris_fact', methods:["GET"])]
    public function chuck_norris_fact()
    {
        return $this->render('/games/chuck_norris_fact/index.html.twig');
    }


}
