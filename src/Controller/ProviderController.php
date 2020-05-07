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
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    private $logService;

    /**
     * @Route("/provider", name="provider")
     * @param TaskService $taskService
     * @param DeveloperService $developerService
     */




    public function index(TaskService $taskService,DeveloperService $developerService)
    {
        $developers = $developerService->findAllOrderByWorkPerTime();

        $week = 1;
        $notCompleted = true;
        while ($notCompleted){
            $tasks = $taskService->findAssignableOrderByEffortPoint();
            if (count($tasks) == 0) $notCompleted = false;
            $developerService->weeklyPlan($developers,$tasks,$week);
            $week++;
        }

        return \Symfony\Component\HttpFoundation\Response::create('ok');


    }
}
