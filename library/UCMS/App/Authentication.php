<?php

class UCMS_App_Authentication
{
    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em;
    protected $_diContainer;

    public function __construct($diContainer)
    {
        $this->_di = $diContainer;
        $this->_em  = $this->_di->doctrine->getEntityManager();
    }
    
    /**
     *
     * @param type $username
     * @param type $password
     * @return Zend_Auth_Result 
     */
    public function userAuthentication($username, $password)
    {
        $authAdapter = new UCMS_Zend_Auth_Adapter_Doctrine($this->_em);
        $authAdapter
            ->setIdentity($username)
            //->setCredential(sha1($password))
            ->setEntityName('Wordy\Entity\User');
        
        return Zend_Auth::getInstance()->authenticate($authAdapter);
    }


}