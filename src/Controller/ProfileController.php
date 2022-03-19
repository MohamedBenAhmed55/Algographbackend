<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileController extends AbstractController
{
   /**
     * @Route("/api/getsingleuser/{id}", name="get_single_user"  , methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getSingleUser(EntityManagerInterface $em, Request $request, $id): Response
    {


        $user = $em->getRepository(User::class)->find($id);
        $name = $user->getNom();
        $lastname = $user->getPrenom();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $score = $user->getScore();
        
        $response = new Response();
        $response->setContent(json_encode([
            'id' => $id,
            'name' => $name,
            'lastname' => $lastname,
            'username' => $username,
            'email' => $email,
            'score' => $score,
        ]));
        $response->headers->set('Content-Type', 'application/json');
        return ($response);
    }
}
