<?php

class UCMS_App_Doctrine
{
    protected $_di;
    
    public function __construct($di)
    {
        $this->_di = $di;
    }
    
    public function updateDbSchema()
    {
        $classes = array('User', 'Post', 'Language');
        $metadata = array();
        
        foreach ($classes as $class) {
            $metadata[] = $this->_di->doctrine->getEntityManager()->getClassMetadata("UCMS\Entity\\" . $class);
        }
        
        $schemaTool = new Doctrine\ORM\Tools\SchemaTool($this->_di->doctrine->getEntityManager());
        
        $schemaTool->updateSchema($metadata);
    }
    
}