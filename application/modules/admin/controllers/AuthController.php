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
        $form = new UCMS_Form_Auth_Login();
        
        $authAdapter = $this->_di->ucmsAppAuth;
        
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $adapter = $authAdapter->userAuthentication(
                    $form->getValue('username'),
                    $form->getValue('password')
            );
            
            if ($adapter->getCode() == Zend_Auth_Result::SUCCESS) {
                $this->_helper->redirector('index', 'index');
            }else{
                //var_dump($adapter);   // !!!!!!!!!!!!!!!!!!!!!!!    
                $this->view->auth = false;
            }
        }
        $this->view->form = $form;
        // Assign variable to layout
        //$this->_helper->layout()->auth = false;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        $this->_helper->redirector('index', 'index');
    }
}
