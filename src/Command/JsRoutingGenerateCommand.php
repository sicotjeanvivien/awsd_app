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
    public function __construct(private RouterInterface $routerInterface)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = dirname(__DIR__, 2) . "/assets/react/Service/routing.json";
        $jsRouting = [];

        foreach ($this->routerInterface->getRouteCollection()->all() as $key => $route) {
            if (!preg_match('/_profiler/', $route->getPath())) {
                $parameters = [];
                $jsPath = str_replace(".{_format}", "", $route->getPath());
                foreach ($route->getRequirements() as $param => $requerement) {
                    $parameters[$param] = "{" . $param . "}";
                }
                
                $jsRouting[$key] = [
                    "path" => $jsPath,
                    "parameters" => $parameters
                ];
            }
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
