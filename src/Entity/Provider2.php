<?php


namespace App\Entity;


use App\Interfaces\IProvider;
use App\Traits\TaskApiCallable;

class Provider2 implements IProvider
{

    use TaskApiCallable;

    private $apiUrl = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';

    function syncTasksFromAPI()
    {
        return;

    }

    function getApiUrl(): string
    {
        return $this->apiUrl;
    }
}