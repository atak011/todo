<?php


namespace App\Services;


use App\Entity\Log;

use App\Repository\LogRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Container;


class LogService
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function create(){

        return $this->em->find(1);
    }

}