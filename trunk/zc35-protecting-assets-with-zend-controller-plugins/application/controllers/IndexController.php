<?php

class IndexController extends Zend_Controller_Action
{
    
    public function indexAction()
    {
	if ($this->getRequest()->isPost())
	{
	    $session = new Zend_Session_Namespace('auth');
	    if ($this->_getParam('secret') == 'secret')
	    {	
		$session->authenticated = true;
		$this->view->message = 'authenticated!';
	    }
	    else
	    {
		$session->authenticated = false;
		$this->view->message = 'authentication failed';
	    }
		

	}
	    
	
    }

}

