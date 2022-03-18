<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

class InfoController extends AbstractController
{
    

    /**
     * @Route("/api/info", name="app_info", methods={"GET"})
     */
    public function index(EntityManagerInterface $em, $id): JsonResponse
    {
        $users = $em->getRepository(User::class)->findBy([]);
        $Data = array();
      /*$present =0;
        $conge=0;
        $mission=0;
        $intérim=0;
       */

        for ($i = 0; $i < sizeof($users); $i++) {
        
            /*if(strcmp($users[$i]->getEtatPresence(),"Présent") == 0 ){
                $present++;
            }
            if(strcmp($users[$i]->getEtatPresence(),"En congé") == 0 ){
                $conge++;
            }
            if(strcmp($users[$i]->getEtatPresence(),"En mission") == 0 ){
                $mission++;
            }
            if(strcmp($users[$i]->getEtatPresence(),"En intérim") == 0 ){
                $intérim++;
            }
            */
            $test = array(
                'nom' =>$users[$i]->getNom(),
                'prenom' => $users[$i]->getPrenom(),
                'score' => $users[$i]->getScore(),
            );
            array_push($Data, $test);


        }
        
        
        $response = new JsonResponse();
        $response->setData(['data' => $Data]);
        return ($response);
    }
}
