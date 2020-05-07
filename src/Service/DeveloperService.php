<?php


namespace App\Service;


use App\Entity\Developer;
use App\Entity\Log;

use App\Entity\Task;
use App\Repository\DeveloperRepository;
use App\Repository\LogRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class DeveloperService
{
    private $repository;
    private $entityManager;
    private $taskService;

    /**
     * DeveloperService constructor.
     * @param DeveloperRepository $rep
     * @param EntityManagerInterface $entityManager
     * @param TaskService $taskService
     */
    public function __construct(DeveloperRepository $rep, EntityManagerInterface $entityManager,TaskService $taskService){
        $this->repository = $rep;
        $this->entityManager = $entityManager;
        $this->taskService = $taskService;
    }

    /**
     * @return int|mixed|string
     */
    public function findAllOrderByWorkPerTime(){
        return $this->repository->findAllOrderByWorkPerTime();
    }

    public function currentWeekEffortPoint(Developer $developer,$week){
        return  $this->taskService->countDeveloperEffortPointRelatedWeek($developer,$week);
    }

    public function canAcceptTaskForThisWeek(Developer $developer,Task $task,$week){
         $currentWeekEffortPoint = $this->currentWeekEffortPoint($developer,$week);
         $remainingEffortPoint = $developer->getWeeklyEffortPoint() - $currentWeekEffortPoint;
         return $task->getEffortPoint() < $remainingEffortPoint;
    }


    public function totalWeeklyEffortPoint(){
        return $this->repository->totalWeeklyEffortPoint()[0]['totalEffortPoint'];
    }

    public function weeklyPlan($developers,$tasks,$week){
        foreach ($developers as $developer) {
            foreach ($tasks as $task) {
                if ($this->canAcceptTaskForThisWeek($developer, $task, $week)) {
                    $this->taskService->assignDeveloper($task, $developer, $week);
                }
            }
        }

    }

}