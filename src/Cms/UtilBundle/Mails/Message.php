<?php

namespace Cms\UtilBundle\Mails;

class Message extends \Swift_Message {

    private $subject;
    private $content;
    private $to;
    private $from;

    public function __construct($to = null, $from = null, $subject = null, $content = null) {
        
        parent::__construct($to, $from, $subject, $content);
        parent::setSubject($subject);
        parent::setTo($to['address'], isset($to['name']) ? $to['name'] : null);
        parent::setFrom($from['address'], isset($from['name']) ? $from['name'] : null);
        parent::setBody($content,'text/html','utf-8');
        
    }
    
    public function setSubject($subject) {
        parent::setSubject($subject);
    }
    
    public function setTo($addresses, $name = null) {
        parent::setTo($addresses, $name);
    }
    
    public function setFrom($addresses, $name = null) {
        parent::setFrom($addresses, $name);
    }
   
    public function setBody($body, $contentType = null, $charset = null) {
        parent::setBody($body, $contentType, $charset);
    }
    
    public function setCharset($charset) {
        parent::setCharset($charset);
    }
    
    public function setPriority($priority) {
        parent::setPriority($priority);
    }
    
    

}
