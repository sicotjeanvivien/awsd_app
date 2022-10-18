<?php

namespace App\Command\MTG;

use App\Entity\MTG\MtgArtist;
use App\Entity\MTG\MtgCard;
use App\Entity\MTG\MtgManaCost;
use App\Entity\MTG\MtgRarity;
use App\Repository\MTG\MtgArtistRepository;
use App\Repository\MTG\MtgCardRepository;
use App\Repository\MTG\MtgColorRepository;
use App\Repository\MTG\MtgManaCostRepository;
use App\Repository\MTG\MtgRarityRepository;
use App\Repository\MTG\MtgSetRepository;
use App\Repository\MTG\MtgSubtypeRepository;
use App\Repository\MTG\MtgSupertypeRepository;
use App\Repository\MTG\MtgTypeRepository;
use App\Service\MtgService;
use mtgsdk\Card;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mtg:card:retrieve',
    description: 'Add a short description for your command',
)]
class MtgCardRetrieveCommand extends Command
{
    protected function configure(): void
    {
    }

    public function __construct(
        private MtgCardRepository $mtgCardRepository,
        private MtgTypeRepository $mtgTypeRepository,
        private MtgSetRepository $mtgSetRepository,
        private MtgSubtypeRepository $mtgSubtypeRepository,
        private MtgSupertypeRepository $mtgSupertypeRepository,
        private MtgManaCostRepository $mtgManaCostRepository,
        private MtgRarityRepository $mtgRarityRepository,
        private MtgArtistRepository $mtgArtistRepository,
        private MtgColorRepository $mtgColorRepository,

        private MtgService $mtgService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        $mtgSet = $this->mtgSetRepository->findOneBy(["code" => "UNF"]);
        // $this->mtgService->loadingCardBySet($mtgSet);
        $io->success("Command END");

        return Command::SUCCESS;
    }
}
