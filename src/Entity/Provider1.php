<?php


namespace App\Entity;


use App\Interfaces\IProvider;
use App\Traits\TaskApiCallable;

class Provider1 implements IProvider
{
    use TaskApiCallable;

    /**
     * @var string
     */
    private $apiUrl = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';

    /**
     * @return array
     * @throws \Exception
     */
    public function getTasksFromAPI():array
    {
        $tasks = [];
        $rawData = $this->getTaskRawDataFromApi();
        foreach ($rawData as $rawTask){
            $tasks[] = new Task($rawTask->id,$rawTask->sure,$rawTask->zorluk);
        }
        return $tasks;
    }

    /**
     * @return string
     */
    function getApiUrl(): string
    {
        return $this->apiUrl;
    }

}