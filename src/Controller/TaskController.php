<?php

namespace App\Controller;

use App\Service\DeveloperService;
use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     * @param TaskService $taskService
     * @return Response
     */
    public function index(TaskService $taskService)
    {
        $tasks = $taskService->findAll();
        $lastTask = $taskService->findAllOrderByWeek();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
            'last_week' => $lastTask[0]->getAssignedWeek(),
        ]);
    }

    /**
     * @Route("/task-sync", name="task-sync")
     * @param TaskService $taskService
     * @param DeveloperService $developerService
     * @return RedirectResponse
     */
    public function task_sync(TaskService $taskService,DeveloperService $developerService)
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
        return Response::create('Planing is completed ! ');
    }
}
