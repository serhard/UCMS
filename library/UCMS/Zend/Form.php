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
        foreach ($this->getElements() as $element) {
            if ($element->getType() == 'Zend_Form_Element_Submit') {
                $element->setDecorators(array(
                    'ViewHelper',
                    array(array('row' => 'HtmlTag'),array('tag' => 'p'))
                ));
            } else {
                $element->setDecorators(array(
                    'ViewHelper',
                    'Description',
                    'Errors',
                    'Label',
                    array(array('data' => 'HtmlTag'), array('tag' => 'p'))
                ));
            }
        }

        $this->setDecorators(array(
            'FormElements',
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
