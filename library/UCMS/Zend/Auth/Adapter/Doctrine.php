<?php

class UCMS_Zend_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
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
    
    public function checkLogin($username, $password)
    {
        $em = $this->di->doctrine->getEntityManager();
        
        $dql = "SELECT u FROM UCMS\Entity\User u WHERE u.username = :username AND u.password = :password";
        $result = $em->createQuery($dql)
            ->setParameter('username', $this->username)
            ->setParameter('password', sha1($this->password))
            ->getArrayResult();
        
        return $result;
    }
    
    public function authenticate() {
       $result = $this->checkLogin(
                            $this->username,
                            $this->password
               );
        
        if (empty($result[0])) {
            return new Zend_Auth_Result(0, array());
        }

        return new Zend_Auth_Result(1, $result[0]);
    }
}
