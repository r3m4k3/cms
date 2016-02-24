<?php

namespace Cms\UtilBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class NotificationService {
    
    private $session;
    
    function __construct(Session $session) {
        $this->session = $session;
    }
    
    protected function addMessage($type, $message){
        $this->session->getFlashBag()->add($type, $message);
    }

    public function addSuccess($message){
        $this->addMessage('success', $message);
    }
    
    public function addError($message){
        $this->addMessage('danger', $message);
    }
    
    public function addWarning($message){
        $this->addMessage('warning', $message);
}
    
    public function addInfo($message){
        $this->addMessage('info', $message);
    }
    
}
