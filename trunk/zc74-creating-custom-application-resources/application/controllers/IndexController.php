<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $this->view->text = new Zend_Form_Element_Textarea('comment');
        $this->view->text->addFilter(new ZC_Filter_HTMLPurifier);
        if ($this->getRequest()->isPost())
        {
            $this->view->text->isValid($this->_getParam('comment'));
        }
    }


}

