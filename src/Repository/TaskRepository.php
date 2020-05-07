<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    // /**
    //  * @return Task[] Returns an array of Task objects
    //  */

    public function findAssignableOrderByEffortPoint($sort='DESC')
    {
        return $this->createQueryBuilder('t')
            ->where('t.assigned_developer is NULL')
            ->andWhere('t.assigned_week is NULL')
            ->orderBy('t.effort_point', $sort)
            ->getQuery()
            ->getResult();
    }

    public function countDeveloperEffortPointRelatedWeek($developerId,$week){
        return $this->createQueryBuilder('t')
            ->where('t.assigned_developer = :developerId')
            ->andWhere('t.assigned_week = :week')
            ->setParameters(['developerId' => $developerId,'week'=>$week])
            ->select('SUM(t.effort_point) as countEffortPoint')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
