<?php

class Admin_AuthController extends UCMS_Zend_Controller_Action
{
    public function init() {
        $this->_helper->layout->setLayout('singlePageLayout');
        parent::init();
    }

    public function indexAction()
    {
        //$this->_di->doctrineApp->updateDbSchema();
        
        if ($this->_request->isPost()) {
            $adapter = new UCMS_Zend_Auth_Adapter_Doctrine(
                    $this->_request->getParam('username'),
                    $this->_request->getParam('password')
            );
            $adapter->setDi($this->_di);
            
            $sonuc = Zend_Auth::getInstance()->authenticate($adapter);
            
            if ($sonuc->getCode() == Zend_Auth_Result::SUCCESS) {
                $this->_helper->redirector('index', 'index');
            }else{
                $this->view->auth = false;
            }
        }
        //$this->_helper->layout()->auth = false;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        $this->_helper->redirector('index', 'index');
    }
}
