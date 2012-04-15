<?php

class UCMS_Form_Auth_Login extends UCMS_Zend_Form
{
    public function init()
    {
        $username = new Zend_Form_Element_Text('username');
        $username
            ->setLabel('Kullanıcı Adı')
            ->setAllowEmpty(false)
            ->addValidator('NotEmpty')
        ;
        
        $password = new Zend_Form_Element_Password('password');
        $password
            ->setLabel('Parola')
            ->setAllowEmpty(false)
            ->addValidator('NotEmpty')
        ;
        
        $submit = new Zend_Form_Element_Submit('loginSubmit');
        $submit
            ->setLabel('Giriş')
            ->setAttrib('class', 'btn primary')
        ;
        
        $this->addElements(array(
            $username,
            $password,
            $submit
        ));
    }
}
