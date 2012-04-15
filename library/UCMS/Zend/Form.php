<?php

class UCMS_Zend_Form extends Zend_Form
{
    protected $_diContainer;
    
    public function setDiContainer($diContainer = null)
    {
        $this->_diContainer = $diContainer;
    }
    
    public function render(Zend_View_Interface $view = null)
    {
        $this->setAttrib('class', 'academicForm linearForm');

        foreach ($this->getElements() as $element) {
            if ($element->getType() == 'Zend_Form_Element_Submit') {
                $element->setDecorators(array(
                    'ViewHelper',
                    //array(array('data' => 'HtmlTag'), array('tag' => 'td')),
                    //array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
                    array(array('row' => 'HtmlTag'),array('tag' => 'div', 'class' => 'actions'))
                ));
            } elseif ($element->getType() == 'Zend_Form_Element_File') {
                $element->setDecorators(array(
                    'File',
                    'Description',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input')),
                    array('Label'),
                    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'clearfix'))
                ));
            } else {
                $element->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'input')),
                    array('Label'),
                    array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'clearfix'))
                ));
            }
        }

        $this->setDecorators(array(
            'FormElements',
            //array('HtmlTag', array('tag' => 'div', 'class' => 'clearfix')),
            'Form',
        ));
        
        return parent::render($view);
    }
    
    public function generateListElementFromObjects($elementType, $elementName, $items, $idField, $valueField)
    {
        $elementType = 'Zend_Form_Element_' . ucfirst($elementType);
        $element = new $elementType($elementName);
        
        foreach ($items as $item) {
            if (is_object($item)) {
                $element->addMultiOption($item->$idField, $item->$valueField);                
            } elseif (is_array($item)) {
                $element->addMultiOption($item[$idField], $item[$valueField]);
            }

        }
        
        return $element;
    }
}
