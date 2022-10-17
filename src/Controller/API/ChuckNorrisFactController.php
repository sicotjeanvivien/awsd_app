<?php

namespace App\Controller\API;

use App\Repository\Games\GamesChuckNorrisFactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class ChuckNorrisFactController extends AbstractController
{

    public function __construct(
        private GamesChuckNorrisFactRepository $gamesChuckNorrisFactRepository,
        private RequestStack $request
    ) {
    }

    public function __invoke()
    {
        dump($this->request->getCurrentRequest()->get("_route"));

        switch ($this->request->getCurrentRequest()->get("_route")) {
            case 'api_games_chuck_norris_facts_random_collection':
                return $this->getFactRandom();
                break;
            
            case 'api_games_chuck_norris_facts_random_collection':
                return $this->getFactRandom();
                break;
            
            default:
                # code...
                break;
        }
    }
    
    
    private function getFactRandom()
    {
        return $this->gamesChuckNorrisFactRepository->findRandom();
    }
}
