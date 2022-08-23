<?php

namespace App\DataFixtures;

use App\Entity\MTG\MtgColor;
use App\Repository\MTG\MtgColorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MtgColorFixtures extends Fixture
{
    public function __construct(private MtgColorRepository $mtgColorRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $colors = [
            ["code" => 'W', "name" => 'White'],
            ["code" => 'U', "name" => 'Blue'],
            ["code" => 'B', "name" => 'Black'],
            ["code" => 'R', "name" => 'Red'],
            ["code" => 'G', "name" => 'Green']
        ];

        foreach ($colors as $key => $color) {
            $mtgColorNew =  new MtgColor();
            $mtgColorNew
                ->setCode($color["code"])
                ->setName($color["name"]);
                $this->mtgColorRepository->add($mtgColorNew, true);
        }
    }
}
