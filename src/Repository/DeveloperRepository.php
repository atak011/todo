<?php

namespace App\Repository;

use App\Entity\Developer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Developer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Developer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Developer[]    findAll()
 * @method Developer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeveloperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Developer::class);
    }

    // /**
    //  * @return Developer[] Returns an array of Developer objects
    //  */

    public function findAllOrderByWorkPerTime($sort='DESC')
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.work_per_time', $sort)
            ->getQuery()
            ->getResult();
    }

    public function totalWeeklyEffortPoint(){
        return $this->createQueryBuilder('d')
            ->select('SUM(d.weekly_effort_point) as totalEffortPoint')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Developer
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
