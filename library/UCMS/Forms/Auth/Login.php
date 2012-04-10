<?php

class UCMS_Forms_Auth_Login extends Zend_Form
{
    public function init() {
        $username = new Zend_Form_Element_Text('username');
        $username
            ->setLabel('Kullanıcı adı')
            ->setDescription('@gazi.edu.tr')
            ->addFilter('StringTrim')
            ->setAllowEmpty(false)
            ->addValidator('NotEmpty')
        ;
    
        $password = new Zend_Form_Element_Password('password');
        $password
            ->setLabel('Parola')
            ->addFilter('StringTrim')
            ->setAllowEmpty(false)
            ->addValidator('NotEmpty')
        ;

        $submit = new Zend_Form_Element_Submit('submit');
        $submit
            ->setLabel('Giriş')
        ;
        
        $this->addElements(array(
            $username,
            $password,
            $submit
        ));        
    }
}