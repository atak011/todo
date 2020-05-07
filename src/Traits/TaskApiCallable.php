<?php


namespace App\Traits;


use App\Entity\Log;
use App\Repository\LogRepository;
use App\Service\LogService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

trait TaskApiCallable
{

    public function getTaskRawDataFromApi(){
        $client = HttpClient::create();
        try {
            return json_decode($client->request('GET', $this->getApiUrl())->getContent());
        } catch (TransportExceptionInterface $e) {

            throw new \Exception($e);
        }
    }


}