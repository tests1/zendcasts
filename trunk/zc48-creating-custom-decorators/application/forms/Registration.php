<?php
class Form_Registration
    extends Zend_Form
{
    public function init()
    {
        $this->addPrefixPath('ZC_Form_Decorator', 
                             'ZC/Form/Decorator',
                             'decorator');

        $this->setMethod('post');
        $fname = new Zend_Form_Element_Text('fname');
        $fname->setLabel('First Name:')->setRequired(true);

        $lname = new Zend_Form_Element_Text('lname');
        $lname->setLabel('Last Name:')->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setValue('Submit');
        
        $this->addElements(array($fname,$lname,$submit));

   
        $this->setDecorators(array('FormElements',
                            array('HtmlTag',array('tag'=>'dl','class' =>'zend_form')),
                            array('MoreInformation',array('placement'=>'PREPEND', 'text' => 'Please provide your first and last name:')),
                            'Form'));


    }
}

