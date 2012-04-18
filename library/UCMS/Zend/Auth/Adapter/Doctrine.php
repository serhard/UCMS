<?php

class UCMS_Zend_Auth_Adapter_Doctrine implements Zend_Auth_Adapter_Interface
{
    protected $_em;
    
    protected $_identityField = 'username';

    protected $_credentialField = 'password';

    protected $_identity;

    protected $_credential;

    protected $_entityName;


    public function __construct($em)
    {
        $this->setEm($em);
    }
    
/*
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
*/    
    public function authenticate()
    {
        $query = $this->_buildQuery();

        $authResult = array(
            'code'     => Zend_Auth_Result::FAILURE,
            'identity' => null,
            'messages' => array()
        );

        try {
            $result = $query->execute(array(
                1 => $this->_identity,
                2 => $this->_credential
            ), Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

            $resultCount = count($result);
            if ($resultCount > 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS;
                $authResult['messages'][] = 'More than one entity matches the supplied identity.';
            } else if ($resultCount < 1) {
                $authResult['code'] = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
                $authResult['messages'][] = 'A record with the supplied identity could not be found.';
            } else if (1 == $resultCount) {
                if ($result[0][$this->_credentialField] != $this->_credential) {
                    $authResult['code'] = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                    $authResult['messages'][] = 'Supplied credential is invalid.';
                } else {
                    $authResult['code'] = Zend_Auth_Result::SUCCESS;
                    $authResult['identity'] = $result[0];
                    $authResult['messages'][] = 'Authentication successful.';
                }
            }
        } catch (\Doctrine\ORM\Query\QueryException $qe) {
            $authResult['code'] = Zend_Auth_Result::FAILURE_UNCATEGORIZED;
            $authResult['messages'][] = $qe->getMessage();
        }

        return new Zend_Auth_Result(
            $authResult['code'],
            $authResult['identity'],
            $authResult['messages']
        );
    }

    protected function _buildQuery()
    {
        $qb = $this->_em->createQueryBuilder()
                ->select('e')
                ->from($this->_entityName, 'e')
                ->where('e.' . $this->_identityField . ' = ?1')
                ->andWhere('e.' . $this->_credentialField . ' = ?2');
        ;

        return $qb->getQuery();
    }

    public function setEm($em)
    {
        $this->_em = $em;
    }

    public function getEm()
    {
        return $this->_em;
    }

    public function setCredential($credential)
    {
        $this->_credential = $credential;
        return $this;
    }

    public function getCredential()
    {
        return $this->_credential;
    }

    public function setCredentialField($credentialField)
    {
        $this->_credentialField = $credentialField;
        return $this;
    }

    public function getCredentialField()
    {
        return $this->_credentialField;
    }

    public function setIdentityField($identityField)
    {
        $this->_identityField = $identityField;
        return $this;
    }

    public function getIdentityField()
    {
        return $this->_identityField;
    }

    public function setIdentity($identity)
    {
        $this->_identity = $identity;
        return $this;
    }

    public function getIdentity()
    {
        return $this->_identity;
    }

    public function setEntityName($entityName)
    {
        $this->_entityName = $entityName;
        return $this;
    }

    public function getEntityName()
    {
        return $this->_entityName;
    }
}