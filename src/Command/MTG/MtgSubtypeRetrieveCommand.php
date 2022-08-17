<?php

namespace App\Command\MTG;

use App\Entity\MTG\MtgSubtype;
use App\Repository\MTG\MtgSubtypeRepository;
use mtgsdk\Subtype;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mtg:subtype:retrieve',
    description: 'Add a short description for your command',
)]
class MtgSubtypeRetrieveCommand extends Command
{
    protected function configure(): void
    {
    }
    public function __construct(
        private MtgSubtypeRepository $mtgSubtypeRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        $subtypeInBDD =  $this->mtgSubtypeRepository->customFieldFindAll("name");
        foreach (subtype::all() as $key => $subtype) {
            if (!in_array($subtype , $subtypeInBDD)) {
                $subtypeNew = new MtgSubtype    ();
                $subtypeNew->setName($subtype);
                $this->mtgSubtypeRepository->add($subtypeNew, true);
            }
        }

        $io->comment("Command END");

        return Command::SUCCESS;
    }
}
