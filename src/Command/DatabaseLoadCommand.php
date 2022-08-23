<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:database:load',
    description: 'Add a short description for your command',
)]
class DatabaseLoadCommand extends Command
{
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $arrayInput = new ArrayInput([
            '--force'  => true,
        ]);
        $this->getApplication()->find("doctrine:database:drop")->run($arrayInput, $output);
        $this->getApplication()->find("doctrine:database:create")->run($input, $output);
        $this->getApplication()->find("doctrine:migrations:migrate")->run($input, $output);
        $this->getApplication()->find("doctrine:fixtures:load")->run($input, $output);
        $this->getApplication()->find("app:mtg:set:retrieve")->run($input, $output);
        $this->getApplication()->find("app:mtg:subtype:retrieve")->run($input, $output);
        $this->getApplication()->find("app:mtg:supertype:retrieve")->run($input, $output);
        $this->getApplication()->find("app:mtg:type:retrieve")->run($input, $output);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
