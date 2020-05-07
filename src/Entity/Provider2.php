<?php


namespace App\Entity;


use App\Interfaces\IProvider;
use App\Traits\TaskApiCallable;

class Provider2 implements IProvider
{

    use TaskApiCallable;

    private $apiUrl = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';

    function getTasksFromAPI()
    {
        $tasks = [];
        $rawData = $this->getTaskRawDataFromApi();
        foreach ($rawData as $rawTask){
            foreach ($rawTask as $taskKey => $taskDetail){
                $tasks[] = new Task($taskKey,$taskDetail->estimated_duration,$taskDetail->level);
            }

        }
        return $tasks;
    }

    function getApiUrl(): string
    {
        return $this->apiUrl;
    }


}