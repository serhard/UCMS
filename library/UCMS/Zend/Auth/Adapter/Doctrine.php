<?php

class UCMS_Zend_Adapter_Doctrine extends Zend_Auth_Adapter_Interface
{
    protected $username;
    protected $password;
    protected $di;
    
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function setDi($di)
    {
        $this->di = $di;
    }
    
    public function checkMailLogin($username, $password)
    {
        try {
            $email = new Zend_Mail_Storage_Imap(array(
                'host' => 'gelenposta.gazi.edu.tr',
                'user' => $username . '@gazi.edu.tr',
                'password' => $password,
                'ssl' => 'SSL'
            ));

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function authenticate()
    {
        $em = $this->di->doctrine->getEntityManager();
        
        if (!$this->checkMailLogin(
            $this->username,
            $this->password)) {
            return new Zend_Auth_Result(0, array());
        }
        
        $dql = 'SELECT u FROM Td\Entity\User u WHERE u.username = :username';
        $result = $em->createQuery($dql)
            ->setParameter('username', $this->username)
            ->getArrayResult();
        
        if (empty($result)) {
            return new Zend_Auth_Result(0, array());
        }
        
        return new Zend_Auth_Result(1, $result[0]);
    }
}