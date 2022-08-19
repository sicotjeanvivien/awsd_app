<?php

namespace App\Command\MTG;

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

    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment("Command START");

        // dump(Card::find(386616));

        $io->success("Command END");

        return Command::SUCCESS;
    }
}
