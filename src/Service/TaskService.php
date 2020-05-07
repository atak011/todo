<?php


namespace App\Service;


use App\Entity\Developer;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private $rep;
    private $entityManager;

    /**
     * TaskService constructor.
     * @param TaskRepository $rep
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TaskRepository $rep, EntityManagerInterface $entityManager)
    {
        $this->rep = $rep;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Task $task
     */
    public function create(Task $task)
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    /**
     * @return int|mixed|string
     */
    public function findAssignableOrderByEffortPoint()
    {
        return $this->rep->findAssignableOrderByEffortPoint();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->rep->findAll();
    }

    /**
     * @param Task $task
     * @param Developer $developer
     * @param $week
     */
    public function assignDeveloper(Task $task, Developer $developer,$week)
    {
        $task->setAssignedDeveloper($developer);
        $task->setAssignedWeek($week);
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    public function countDeveloperEffortPointRelatedWeek(Developer $developer,$week)
    {
       return $this->rep->countDeveloperEffortPointRelatedWeek($developer->getId(),$week)[0]['countEffortPoint'];
    }



}