<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $u = new Model_User();
        $u->name = time();
        $u->save();
        if ($this->getRequest()->isPost())
        {
            $newUser = new Model_User();
            $newUser->name = $this->_getParam('name');
            $newUser->email = $this->_getParam('email');
            $newUser->car_id = $this->_getParam('car_id');
            $newUser->save();
        }
    }
}

