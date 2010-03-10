<?php
class Form_Registration
    extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name:')->setRequired(true);

        $cellPhone = new ZC_Form_Element_Phone('phone');
        $cellPhone->setLabel('Cell Number:')->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        

        $this->addElements(array($name,$cellPhone, $submit));
    }
}

