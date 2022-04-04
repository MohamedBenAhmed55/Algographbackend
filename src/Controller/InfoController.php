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
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $users = $em->getRepository(User::class)->findBy([]);
        $Data = array();
      
        for ($i = 0; $i < sizeof($users); $i++) {
                  
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
