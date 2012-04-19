<?php

class UCMS_App_Authentication
{
    protected $_em;
    protected $_diContainer;
    protected $_loggedInUser = null;
    
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
    
    public function getLoggedInUser($asObject = false)
    {
        if ($asObject) {
            return $this->getUser($this->getLoggedInUserId());
        }

        if (null === $this->_loggedInUser) {
            $this->_loggedInUser = Zend_Auth::getInstance()->getIdentity();
        }
        
        return $this->_loggedInUser;
    }
    
    public function getLoggedInUserId()
    {
        if ($this->isUserLoggedIn()) {
            $user = Zend_Auth::getInstance()->getIdentity();
            return $user['id'];
        }
        
        return null;
    }

    public function getLoggedInUserObject()
    {
        return $this->_diContainer->doctrine->getEntityManager()->find(
            'Wordy\Entity\User', $this->getLoggedInSiteId()
        );
    }
    
    public function isUserLoggedIn()
    {
        return Zend_Auth::getInstance()->hasIdentity();
    }
    
    public function getUser($userId)
    {
        return $this->_em->find('Wordy\Entity\User', $userId);
    }

}