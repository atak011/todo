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

    public function __construct(LogRepository $rep,EntityManagerInterface $entityManager){
        $this->rep = $rep;
        $this->entityManager = $entityManager;
    }

    public function create(Log $log){

        return $this->entityManager->persist($log);
    }

}