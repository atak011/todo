<?php

namespace App\Controller;

use App\Entity\Log;
use App\Entity\Provider2;
use App\Services\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    private $logService;
    private $messageGenerator;

    /**
     * @Route("/provider", name="provider")
     *
     */



    public function index()
    {


//        $log = new Log('Adana','iyi',new \DateTime());

//        new LogService();

        return (new LogService)->create();

//        return (new Provider2($this->getDoctrine()->getManager()))->getTaskFromApi();
//        $sen = json_decode($result);
//        foreach ($sen as $key => $result){
//            foreach ($result as $sen => $ben){
//                dd($ben);
//            }
//        }
//        return new Response('',200);


//        $sen = (new LogService())->create($log);

        return ;
//        return $this->render('provider/index.html.twig', [
//            'controller_name' => 'ProviderController',
//        ]);


    }
}
