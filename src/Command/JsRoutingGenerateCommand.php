<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Routing\RouterInterface;

#[AsCommand(
    name: 'app:js:routing:generate',
    description: 'Add a short description for your command',
)]
class JsRoutingGenerateCommand extends Command
{
    protected function configure(): void
    {
    }
    public function __construct(private RouterInterface $route)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = dirname(__DIR__, 2) . "/assets/react/Service/routing.json";
        $jsRouting = [];
        foreach ($this->route->getRouteCollection()->all() as $key => $route) {
            $jsRouting[$key] = ["path" => $route->getPath()];
        }

        if ($filename) {
            $file = fopen($filename, "w");
            fwrite($file, json_encode($jsRouting));
            fclose($file);
        }
        
        $io->success('routing.json created.');
        return Command::SUCCESS;
    }
}
