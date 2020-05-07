<?php

namespace App\Controller;

use App\Entity\Log;
use App\Entity\Provider1;
use App\Entity\Provider2;
use App\Repository\DeveloperRepository;
use App\Service\DeveloperService;
use App\Service\LogService;
use App\Service\TaskService;
use App\Service\TwitterClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    private $logService;
    private $twitterClient;

    /**
     * @Route("/provider", name="provider")
     *
     */



    public function index(TaskService $taskService,DeveloperService $developerService)
    {

        $tasks = $taskService->findAllOrderByEffortPoint();
        $developers = $developerService->findAllOrderByWorkPerTime();
        dd($tasks);
        foreach ($tasks as $task){
            foreach ($developers as $developer){
                // ATADIKTAN SONRA ÇIK
            }
        }


    }
}
