<?php

namespace Cms\UserBundle\Service;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginListener {
    
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;
    
    /** @var \Doctrine\ORM\EntityManager */
    private $em;
    
    private $session;
    
    /**
    * Constructor
    *
    * @param SecurityContext $securityContext
    * @param Doctrine $doctrine
    */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine, Session $session)
    {
        $this->securityContext = $securityContext;
        $this->em = $doctrine->getManager();
        $this->session = $session;
    }
    
    /**
    * Do the magic.
    *
    * @param InteractiveLoginEvent $event
    */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY') && false === $this->securityContext->isGranted('ROLE_ADMIN')) {
            $userData = $this->em->find('Cms\UserBundle\Entity\User', $user->getid());
            $loginDate = new \DateTime();
            $userData->setLastLoginDate($loginDate);
            $this->em->persist($userData);
            $this->em->flush();

        }
        
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            
        }
        // do some other magic here
        
    }
}