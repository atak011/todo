<?php


namespace App\Service;


use App\Entity\Log;

use App\Repository\DeveloperRepository;
use App\Repository\LogRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class DeveloperService
{
    private $rep;
    private $entityManager;

    public function __construct(DeveloperRepository $rep,EntityManagerInterface $entityManager){
        $this->rep = $rep;
        $this->entityManager = $entityManager;
    }

    public function findAllOrderByWorkPerTime(){
        return $this->rep->findAllOrderByWorkPerTime();
    }

    public function assignTask(){

    }

}