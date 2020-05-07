<?php

namespace App\Command;

use App\Entity\Provider1;
use App\Entity\Provider2;
use App\Service\TaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncTaskCommand extends Command
{
    protected static $defaultName = 'SyncTask';
    private $taskService;

    public function __construct(string $name = null,TaskService $taskService)
    {
        parent::__construct($name);
        $this->taskService = $taskService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Sync All Task')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $provider1 = (new Provider1())->getTasksFromAPI();
            $provider2 = (new Provider2())->getTasksFromAPI();
            $allTasks = array_merge($provider1,$provider2);
            foreach ($allTasks as $task){
                $this->taskService->create($task);
            }
            $io->success('Well done !! All Tasks synced successfully');
        }catch (\Exception $exception){
            $io->error('Error : '.$exception);
        }





        return 0;
    }
}
