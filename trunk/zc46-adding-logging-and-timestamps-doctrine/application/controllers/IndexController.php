<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        if ($this->getRequest()->isPost())
        {
            $adapter = new ZC_Auth_Adapter($this->_getParam('username'), $this->_getParam('password'));
            $result = Zend_Auth::getInstance()->authenticate($adapter);

            if (Zend_Auth::getInstance()->hasIdentity())
            {
                $this->_forward('secret');
            }
            else
            {
                $this->view->message = implode(' ', $result->getMessages());
            }

        }
    }
    public function editAction()
    {
        if (!Zend_Auth::getInstance()->hasIdentity())
            $this->_redirect('/');

        if ($this->getRequest()->isPost())
        {
            $user = Zend_Auth::getInstance()->getIdentity();
            $user->email = $this->_getParam('email');
            $user->save();
        }
        
    }
    public function secretAction()
    {

        if (!Zend_Auth::getInstance()->hasIdentity())
            $this->_redirect('/');
    }
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }

}

