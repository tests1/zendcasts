<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $this->view->form = new Form_Registration();

        if ($this->getRequest()->isPost()
                && $this->view->form->isValid($this->_getAllParams()))
        {
            
        }
    }
    public function validateformAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        //$this->_helper->getHelper('layout')->disableLayout();

        $f = new Form_Registration();
        $f->isValid($this->_getAllParams());
        $json = $f->getMessages();
        header('Content-type: application/json');
        echo Zend_Json::encode($json);
    }

}

