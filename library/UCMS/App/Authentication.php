<?php

class UCMS_App_Authentication
{
    protected $_em;
    protected $_diContainer;

    public function __construct($diContainer)
    {
        $this->_di = $diContainer;
        $this->_em  = $this->_di->doctrine->getEntityManager();
    }
    
    public function userAuthentication($username, $password)
    {
        $authAdapter = new UCMS_Zend_Auth_Adapter_Doctrine($this->_em);
        $authAdapter
            ->setIdentity($username)
            ->setCredential(sha1($password))
            ->setEntityName('UCMS\Entity\User');
        
        return Zend_Auth::getInstance()->authenticate($authAdapter);
    }
}