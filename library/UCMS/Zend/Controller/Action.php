<?php

class UCMS_Zend_Controller_Action extends Zend_Controller_Action
{
    protected $_di;
    
    public function init() {
        $this->_di = $this->_helper->dependencyInjection->getContainer();
        
        if (!Zend_Auth::getInstance()->hasIdentity() && $this->_request->getControllerName() !== 'auth' ) {
            $this->_helper->redirector->gotoSimple('index', 'auth');
        }
        
    }
}