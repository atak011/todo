<?php

namespace App\Interfaces;


interface IProvider
{

    function getApiUrl():string ;

    function getTasksFromAPI() ;


}