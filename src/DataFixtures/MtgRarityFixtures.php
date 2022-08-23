<?php

namespace App\DataFixtures;

use App\Entity\MTG\MtgRarity;
use App\Repository\MTG\MtgRarityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MtgRarityFixtures extends Fixture
{
    public function __construct(private MtgRarityRepository $mtgRarityRepository)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $rarities = [
            ["name" =>  "Common"],
            ["name" => "Uncommon"],
            ["name" => "Rare"],
            ["name" => "Mythic"],
            ["name" => "Mythic Rare"],
            ["name" => "Special"],
            ["name" => "Basic Land"]
        ];

        foreach ($rarities as $key => $rarity) {
            $mtgRarityNew = new MtgRarity();
            $mtgRarityNew->setName($rarity["name"]);
            $this->mtgRarityRepository->add($mtgRarityNew, true);
        }
    }
}
