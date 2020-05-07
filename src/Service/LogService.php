<?php


namespace App\Service;


use App\Entity\Log;

use App\Repository\LogRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class LogService
{
    private $rep;
    private $entityManager;

    /**
     * LogService constructor.
     * @param LogRepository $rep
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LogRepository $rep, EntityManagerInterface $entityManager){
        $this->rep = $rep;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Log $log
     */
    public function create(Log $log){

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }

}