<?php

namespace App\Controller\API;

use App\Repository\Games\GamesChuckNorrisFactRepository;
use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class ChuckNorrisFactController extends AbstractController
{

    public function __construct(
        private GamesChuckNorrisFactRepository $gamesChuckNorrisFactRepository,
        private RequestStack $request
    ) {
    }

    public function __invoke($id = null)
    {
        dump([$this->request->getCurrentRequest()->get("_route"), $id]);

        switch ($this->request->getCurrentRequest()->get("_route")) {
            case 'api_games_chuck_norris_facts_random_collection':
                return $this->getFactRandom();
                break;

            case 'api_games_chuck_norris_facts_putCustom_item':
                return $this->putCustom($id);
                break;

            default:
                return ["error" => "404"];
                break;
        }
    }


    private function getFactRandom()
    {
        return $this->gamesChuckNorrisFactRepository->findRandom();
    }

    private function putCustom($id)
    {
        $fact = $this->gamesChuckNorrisFactRepository->find($id);
        
        
        return ["hello boyys"];
    }
}
