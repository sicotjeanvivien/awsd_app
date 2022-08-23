<?php

namespace App\Command\MTG;

use App\Entity\MTG\MtgType;
use App\Repository\MTG\MtgTypeRepository;
use mtgsdk\Type;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mtg:type:retrieve',
    description: 'Add a short description for your command',
)]
class MtgTypeRetrieveCommand extends Command
{
    protected function configure(): void
    {
    }

    public function __construct(
        private MtgTypeRepository $mtgTypeRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        $typeInBDD =  $this->mtgTypeRepository->customFieldFindAll("name");
        foreach (Type::all() as $key => $type) {
            if (!in_array($type, $typeInBDD)) {
                $typeNew = new MtgType();
                $typeNew->setName($type);
                $this->mtgTypeRepository->add($typeNew, true);
            }
        }

        $io->comment("Command END");
        return Command::SUCCESS;
    }
}
