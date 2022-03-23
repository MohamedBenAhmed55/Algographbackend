<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Cast\String_;

class JWTCreatedListener
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * 
     *
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        $payload       = $event->getData();
        $payload['ip'] = $request->getClientIp();

        // $this->em->getrep(User::class)->findBy(['username'=>$payload['username']]);
        // $user = $this->em->getRepository(User::class)->findOneby(['username'=>$payload['username']]);

        /** @var $user \App\Entity\User */
        $user = $this->em->getRepository(User::class)->findOneby(['username' => $payload['username']]);       
        $payload['UserId'] = $user->getId();;
        $event->setData($payload);
        $header = $event->getHeader();
        $event->setHeader($header);
    }
}