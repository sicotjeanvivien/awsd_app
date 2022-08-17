<?php

namespace App\Command\MTG;

use App\Entity\MTG\MtgSupertype;
use App\Repository\MTG\MtgSupertypeRepository;
use mtgsdk\Supertype;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mtg:supertype:retrieve',
    description: 'Add a short description for your command',
)]
class MtgSupertypeRetrieveCommand extends Command
{
    protected function configure(): void
    {
    }
    public function __construct(
        private MtgSupertypeRepository $mtgSupertypeRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        $supertypeInBDD =  $this->mtgSupertypeRepository->customFieldFindAll("name");
        foreach (Supertype::all() as $key => $supertype) {
            if (!in_array($supertype, $supertypeInBDD)) {
                $supertypeNew = new MtgSupertype();
                $supertypeNew->setName($supertype);
                $this->mtgSupertypeRepository->add($supertypeNew, true);
            }
        }

        $io->comment("Command END");

        return Command::SUCCESS;
    }
}
