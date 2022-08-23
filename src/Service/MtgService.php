<?php

namespace App\Service;

use App\Entity\MTG\MtgArtist;
use App\Entity\MTG\MtgCard;
use App\Entity\MTG\MtgManaCost;
use App\Entity\MTG\MtgRarity;
use App\Entity\MTG\MtgSet;
use App\Repository\MTG\MtgArtistRepository;
use App\Repository\MTG\MtgCardRepository;
use App\Repository\MTG\MtgColorRepository;
use App\Repository\MTG\MtgManaCostRepository;
use App\Repository\MTG\MtgRarityRepository;
use App\Repository\MTG\MtgSetRepository;
use App\Repository\MTG\MtgSubtypeRepository;
use App\Repository\MTG\MtgSupertypeRepository;
use App\Repository\MTG\MtgTypeRepository;
use Exception;
use mtgsdk\Card;

class MtgService
{
    public function __construct(
        private MtgCardRepository $mtgCardRepository,
        private MtgTypeRepository $mtgTypeRepository,
        private MtgSetRepository $mtgSetRepository,
        private MtgSubtypeRepository $mtgSubtypeRepository,
        private MtgSupertypeRepository $mtgSupertypeRepository,
        private MtgManaCostRepository $mtgManaCostRepository,
        private MtgRarityRepository $mtgRarityRepository,
        private MtgArtistRepository $mtgArtistRepository,
        private MtgColorRepository $mtgColorRepository
    ) {
    }

    public function loadingCardBySet(MtgSet $mtgSet)
    {

        try {
            foreach (Card::where(["set" => $mtgSet->getCode()])->all() as $key => $card) {
                // NEW MtgCard
                $cardNew = new MtgCard();
                $cardNew
                    ->setName($card->name)
                    ->setMtgSet($mtgSet)
                    ->setMtgRarity($this->mtgRarityRepository->findOneBy(["name" => $card->rarity]) ?? null)
                    ->setNumber($card->number)
                    ->setPower($card->power ?? null)
                    ->setToughness($card->toughness ?? null)
                    ->setMultiverseid($card->multiverseid ?? null)
                    ->setForeignTexts(isset($card->foreignNames) ? json_encode($card->foreignNames) : null)
                    ->setImageUrl($card->imageUrl ?? null);

                // MtgCard::mtgArtist
                $artist =  $this->mtgArtistRepository->findOneBy(["name" => $card->artist]);
                if (empty($artist)) {
                    $mtgArtistNew =  new MtgArtist();
                    $mtgArtistNew->setName($card->artist);
                    $artist = $this->mtgArtistRepository->add($mtgArtistNew, true);
                }
                $cardNew->setMtgArtist($artist ?? null);

                // MtgCard::mtgSuperType
                if (isset($card->supertypes)) {
                    foreach ($card->supertypes as $key => $superType) {
                        $mtgSupertype = $this->mtgSupertypeRepository->findOneBy(["name" => $superType]);
                        !empty($mtgSupertype) && $cardNew->addSuperType($mtgSupertype);
                    }
                }

                // MtgCard::mtgType
                if (isset($card->types)) {
                    foreach ($card->types as $key => $type) {
                        $mtgType = $this->mtgTypeRepository->findOneBy(["name" => $type]);
                        !empty($mtgType) && $cardNew->addMtgType($mtgType);
                    }
                }

                // MtgCard::mtgSubtype
                if (isset($card->subtypes)) {
                    foreach ($card->subtypes as $key => $subtype) {
                        $mtgSubtype = $this->mtgSubtypeRepository->findOneBy(["name" => $subtype]);
                        !empty($mtgSubtype) && $cardNew->addMtgSubtype($mtgSubtype);
                    }
                }

                // MTGCard::mtgManaCost
                if (isset($card->colorIdentity)) {
                    foreach ($card->colorIdentity as $key => $colorIdentity) {
                        $mtgColor =  $this->mtgColorRepository->findOneBy(["code" => $colorIdentity]);
                        $mtgManaCostNew = new MtgManaCost();
                        $mtgManaCostNew
                            ->setCost(1)
                            ->setColor($mtgColor);
                        $this->mtgManaCostRepository->add($mtgManaCostNew);
                        $cardNew->addMtgManaCost($mtgManaCostNew);
                    }
                }
                $this->mtgCardRepository->add($cardNew, true);
            }
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }
}
