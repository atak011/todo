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

    public function __construct(TaskRepository $rep,EntityManagerInterface $entityManager){
        $this->rep = $rep;
        $this->entityManager = $entityManager;
    }

    public function create(Task $task){
       $this->entityManager->persist($task);
       $this->entityManager->flush();
    }

    public function findAllOrderByEffortPoint(){
        return $this->rep->findAllOrderByEffortPoint();
    }

    public function findAll():array {
        return $this->rep->findAll();
    }

    /**
     * @param Task $task
     * @param $developerId
     */
    public function assignDeveloper(Task $task,Developer $developer) {
        $task->setAssignedDeveloper($developer);
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }





}