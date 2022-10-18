<?php

namespace App\Command\MTG;

use App\Entity\MTG\MtgSet;
use App\Repository\MTG\MtgSetRepository;
use mtgsdk\Set;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mtg:set:retrieve',
    description: 'Add a short description for your command',
)]
class MtgSetRetrieveCommand extends Command
{
    protected function configure(): void
    {
    }

    public function __construct(
        private MtgSetRepository $mtgSetRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        $setInBDD =  $this->mtgSetRepository->customFieldFindAll("name");
        foreach (Set::all() as $key => $set) {
            if (!in_array($set->name, $setInBDD)) {
                $setNew = new MtgSet();
                $setNew
                    ->setCode($set->code)
                    ->setName($set->name)
                    ->setReleaseDate(new \DateTime($set->releaseDate))
                    ->setOnlineOnly($set->onlineOnly);
                $this->mtgSetRepository->add($setNew, true);
            }
        }

        $io->comment("Command END");
        return Command::SUCCESS;
    }
}
